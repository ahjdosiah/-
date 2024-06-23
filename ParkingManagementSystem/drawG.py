import os
import tempfile
import traceback
import shutil

try:
    # 创建一个临时目录，并设置 MPLCONFIGDIR 环境变量
    tempdir = tempfile.mkdtemp()
    os.environ['MPLCONFIGDIR'] = tempdir

    # 确保目录存在
    os.makedirs(os.environ['MPLCONFIGDIR'], exist_ok=True)

    from sqlalchemy import create_engine
    import pandas as pd
    import matplotlib.pyplot as plt
    import matplotlib.font_manager as fm

    # 设置中文字体
    font_path = '/usr/share/fonts/noto/NotoSansCJKsc-Bold.otf'  # 根据实际字体路径调整
    font_prop = fm.FontProperties(fname=font_path)
    plt.rcParams['font.family'] = font_prop.get_name()

    print("Connecting to database...")
    # 数据库连接配置
    db_config = {
        'host': 'localhost',
        'user': 'admin',
        'password': 'password',
        'database': 'parking'
    }

    # 创建连接字符串
    connection_string = f"mysql+pymysql://{db_config['user']}:{db_config['password']}@{db_config['host']}/{db_config['database']}"

    # 创建 SQLAlchemy 引擎
    engine = create_engine(connection_string)

    print("Executing SQL query...")
    # 执行SQL查询从数据库中获取数据
    query = "SELECT carIn, money FROM parkingnote"
    df = pd.read_sql_query(query, engine)

    # 提取SUM(taoc)的值，并处理可能的NaN情况
    sum = "SELECT SUM(taoc) as total_sum FROM maninfo"
    result = pd.read_sql_query(sum, engine)
    total_sum = result.loc[0, 'total_sum'] if result.loc[0, 'total_sum'] is not None else 0
    # 关闭引擎
    engine.dispose()

    # 确保carIn列是日期类型
    df['carIn'] = pd.to_datetime(df['carIn'])

    # 按月份分组并汇总总收费
    df['month'] = df['carIn'].dt.to_period('M')
    monthly_revenue = df.groupby('month')['money'].sum().reset_index()

    # 将月份转回日期格式方便绘图
    monthly_revenue['month'] = monthly_revenue['month'].dt.to_timestamp()

    print("Generating plot...")
    # 使用Matplotlib绘制折线图
    plt.figure(figsize=(10, 5))
    plt.plot(monthly_revenue['month'], monthly_revenue['money'], marker='o')
    plt.title('收费分析', fontproperties=font_prop)
    plt.xlabel('月份', fontproperties=font_prop)
    plt.ylabel('总营收/月', fontproperties=font_prop)
    plt.grid(True)
    plt.xticks(rotation=45)
    plt.tight_layout()

    # 标出每个点的坐标
    for idx, row in monthly_revenue.iterrows():
        xytext_offset = (0, 10)  # 调整偏移量以适应数据点的位置
        xnum = row['money'] + total_sum
        annotation_text = f"({row['month'].strftime('%y/%m')}, {xnum})"
        plt.annotate(annotation_text,
                     xy=(row['month'], row['money']),
                     xytext=xytext_offset,
                     textcoords='offset points',
                     fontproperties=font_prop,
                     ha='center')

    # 获取当前工作目录
    current_dir = os.path.dirname(os.path.abspath(__file__))
    save_dir = os.path.join(current_dir, 'image')

    # 指定保存路径
    file_path = os.path.join(save_dir, 'earn.png')

    # 创建目录（如果不存在）
    if not os.path.exists(save_dir):
        os.makedirs(save_dir)

    print(f"Saving plot to {file_path}...")
    # 保存图表为图片文件，直接覆盖
    plt.savefig(file_path, bbox_inches='tight')
    plt.close()  # 确保关闭图形文件，以释放文件句柄

    # 清理临时目录
    shutil.rmtree(tempdir)

    # 打印成功信息
    print(f"Generated and saved plot at {file_path}")

except Exception as e:
    # 打印异常信息
    print("An error occurred:")
    print(str(e))
    print(traceback.format_exc())

finally:
    if os.path.exists(tempdir):
        shutil.rmtree(tempdir)
