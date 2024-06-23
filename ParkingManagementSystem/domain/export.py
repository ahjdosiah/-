import pymysql
from datetime import datetime
import os

# 连接到MySQL数据库
conn = pymysql.connect(host='localhost', port=3306, user='admin', password='password', db='parking')

# 获取游标
cursor = conn.cursor()

# 获取所有表名
cursor.execute("SHOW TABLES")
tables = cursor.fetchall()

# 导出每个表的结构和数据
timestamp = datetime.now().strftime('%Y%m%d%H%M%S')
output_path = f'../exports/{timestamp}.sql'

# 确保输出目录存在
output_dir = os.path.dirname(output_path)
if not os.path.exists(output_dir):
    os.makedirs(output_dir)

with open(output_path, 'w') as f:
    for table_name in tables:
        table_name = table_name[0]
        # 导出创建表的SQL语句
        cursor.execute(f"SHOW CREATE TABLE {table_name}")
        create_table_sql = cursor.fetchone()[1]
        f.write(f"{create_table_sql};\n\n")

        # 导出插入数据的SQL语句
        cursor.execute(f"SELECT * FROM {table_name}")
        columns = [col[0] for col in cursor.description]
        rows = cursor.fetchall()
        f.write(f"INSERT INTO {table_name} ({', '.join(columns)}) VALUES\n")
        for i, row in enumerate(rows):
            placeholders = ', '.join(['%s'] * len(row))
            values = ', '.join(str(x) for x in row)
            f.write(f"({placeholders}){(',' if i < len(rows) - 1 else ';')}\n")
        f.write("\n\n")
    print(f"文件已保存到: {output_path}")
# 关闭数据库连接
conn.close()