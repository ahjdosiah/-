import mysql.connector
from faker import Faker
from datetime import datetime,timedelta
import random
import string

# 生成中文汽车品牌
def generate_car_brand_cn():
    car_brands_cn = [
        "丰田", "本田", "福特", "雪佛兰", "宝马", "奔驰", "奥迪",
        "大众", "尼桑", "现代", "起亚", "斯巴鲁", "雷克萨斯", "特斯拉",
        "保时捷", "捷豹", "路虎", "沃尔沃", "马自达", "讴歌", "吉普",
        "道奇", "兰博基尼", "法拉利", "玛莎拉蒂", "阿尔法·罗密欧", "菲亚特",
        "林肯", "凯迪拉克", "别克", "本田", "日产", "三菱", "铃木", 
        "英菲尼迪", "克莱斯勒", "悍马", "斯柯达", "吉利", "比亚迪", "长安",
        "哈弗", "奇瑞", "江淮", "红旗"
    ]
    return random.choice(car_brands_cn)

#生成中文颜色
def generate_color_cn():
    colors_cn = ["红色", "橙色", "黄色", "蓝色", "紫色","黑色", "白色"]
    return random.choice(colors_cn)

#生成车牌号
def generate_license_plate():
    # "赣"是江西省的省份简称
    province_short_name = "赣"
    # 生成第一个字母
    first_letter = random.choice(string.ascii_uppercase)
    # 生成第二部分，包括1个字母和4个数字
    sequence = random.choice(string.ascii_uppercase) + ''.join(random.choice(string.digits) for _ in range(4))
    # 拼接完整的车牌号码
    license_plate = f"{province_short_name}{first_letter}-{sequence}"
    return license_plate

#生成车辆进出时间
def generate_parking_times(start_year, end_year):
    # 设置起始日期和截止日期
    start_date = datetime(start_year, 1, 1)
    end_date = datetime(end_year, 12, 31)
    
    # 计算时间差
    time_diff = end_date - start_date
    
    # 生成随机天数
    random_days = random.randint(0, time_diff.days)
    
    # 生成随机秒数用于具体时间
    random_seconds = random.randint(0, 86399)  # 一天有86400秒
    
    # 计算carIn随机时间
    carIn = start_date + timedelta(days=random_days, seconds=random_seconds)
    
    # 生成0到24小时的随机时间间隔
    random_hours = random.randint(0, 23)
    random_minutes = random.randint(0, 59)
    
    # 计算时间间隔
    time_delta = timedelta(hours=random_hours, minutes=random_minutes)
    
    # 计算carOut时间
    carOut = carIn + time_delta
    
    return carIn, carOut

# 生成车位编号和位置
def generate_random_stallIDSpace(cfs,cws):
    # 生成前两位数字，01到05
    first_two_digits = random.randint(1, cfs)
    letter = chr(first_two_digits + 64)
    # 生成后三位数字，000到400
    last_three_digits = f"{random.randint(0, cws):03d}"
    
    # 拼接字符串
    space = f"{letter}区{last_three_digits}号"
    first_two_digits = f"{first_two_digits:02d}"
    random_string = first_two_digits + last_three_digits
    
    return random_string,space

#生成住户的地址
def generate_community_address(ls,dys,cs,hs):
    # 生成随机的楼栋号
    building = f"{random.randint(1, ls)}栋"
    # 生成随机的单元号
    unit = f"{random.randint(1, dys)}单元"
    # 随机选择楼层，范围从1到7
    floor = random.randint(1, cs)
    # 随机选择房间号，范围从1到4
    room = random.randint(1, hs)
    # 生成门牌号，楼层号*100加上房间号
    door_number = f"{floor * 100 + room}"
    return f"{building}{unit}{door_number}"

#计算收费
def calculate_fee(timestamp, fees):
    # 首先根据timeType对费率信息进行排序
    fees_sorted = sorted(fees, key=lambda x: x['timeType'])
    
    # 遍历排序后的费率列表，找到合适的费率
    for i in range(len(fees_sorted) - 1):
        if fees_sorted[i]['timeType'] <= timestamp < fees_sorted[i + 1]['timeType']:
            # 如果timestamp在两个timeType之间，返回当前timeType的fee
            return fees_sorted[i]['fee']
    
    # 如果timestamp大于或等于最后一个timeType，返回最后一个fee
    return fees_sorted[-1]['fee']

#获取处罚和处罚原因
def generate_parking_punish():
    # 定义停车场的处罚原因和对应的处罚
    penalties = {
        "占用他人停车位": "禁止进入该停车场7天",
        "未按规定停车": "禁止进入该停车场30天",
        "停车超时": "禁止进入该停车场15天",
        "未支付停车费": "禁止进入该停车场90天",
        "在禁停区域停车": "禁止进入该停车场180天",
        "占用残疾人专用车位": "禁止进入该停车场365天",
        "阻碍交通": "禁止进入该停车场2年",
        "违停占用消防通道": "禁止进入该停车场3年",
        "长时间占用临时停车位": "禁止进入该停车场1年",
        "未悬挂车牌停车": "禁止进入该停车场6个月"
    }

    # 随机选择一个处罚原因
    reason = random.choice(list(penalties.keys()))
    # 获取对应的处罚
    punish = penalties[reason]

    return reason, punish

fake = Faker('zh-CN')

# 设置数据库连接参数
db_connection = mysql.connector.connect(
  host="localhost",
  user="admin",
  passwd="password",
  database="parking"
)

# 创建cursor对象
cursor = db_connection.cursor(dictionary=True)

query = "SELECT * FROM fees ORDER BY timeType"
cursor.execute(query)
fees_data = cursor.fetchall()

insert_query_carinfo = "INSERT INTO carinfo (carID,color,brand) VALUES (%s, %s, %s)"
insert_query_maninfo = "INSERT INTO maninfo (name,stallID,carID,phone,address) VALUES (%s, %s, %s,%s,%s)"
insert_query_stall = "INSERT INTO stall (stallID,carID,space,isfixed) VALUES (%s, %s, %s,%s)"
insert_query_parkingnote = "INSERT INTO parkingnote (stallID,carID,carIn,carOut,time,money) VALUES (%s, %s, %s,%s,%s,%s)"
insert_query_blackcar = "INSERT INTO blackcar (carID,time,punish,reason) VALUES (%s, %s, %s,%s)"

selct_query_otherinfo = "SELECT * FROM baseinfo"
#生成并插入假数据
try:
    cursor.execute(selct_query_otherinfo)
    row = cursor.fetchone()

    for _ in range(50):
        carId = generate_license_plate()
        color = generate_color_cn()
        brand = generate_car_brand_cn()

        name = fake.name()
        stallId,space = generate_random_stallIDSpace(row['cfs'],row['cws'])
        phone = fake.phone_number()
        address = generate_community_address(row['ls'],row['dys'],row['cs'],row['hs'])
        
        carIn, carOut = generate_parking_times(2020, 2023)
        time = carOut - carIn
        time_spend =  time.seconds / 3600
        money = calculate_fee(time_spend,fees_data)

        reason,punish = generate_parking_punish()

        # 执行插入 
        cursor.execute(insert_query_carinfo, (carId,color,brand))
        if(space[0] in ['A','B']):
            money = 0
            cursor.execute(insert_query_maninfo, (name,stallId,carId,phone,address))
            cursor.execute(insert_query_stall, (stallId,carId,space,1))
        else:
            cursor.execute(insert_query_stall, (stallId,' ',space,0))
            if(random.random() <= 0.1):
                cursor.execute(insert_query_blackcar, (carId,carOut,punish,reason))
        cursor.execute(insert_query_parkingnote, (stallId,carId,carIn,carOut,time,money))

    db_connection.commit()  # 提交事务
    print("Fake data inserted successfully")
except mysql.connector.Error as err:
    print("Error: ", err)
    db_connection.rollback()  # 事务回滚

# 关闭资源
cursor.close()
db_connection.close()