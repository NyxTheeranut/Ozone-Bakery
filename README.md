# Ozone-Bakery
ระบบสั่งซื้อเบเกอรี่

---

## About
Website ร้านเบเกอรี่ที่มีทั้งระบบเลือกซื้อสินค้าแบบพร้อมขายและสั่งทำ (Made to Order) โดยลูกค้าเข้ามารับสินค้าที่ร้านโดยตรงตามวันนัดรับที่ระบุไว้


---

## Setup
วิธีการติดตั้งโปรเจค
1. clone โปรเจคนี้มาใว้บนคอมพิเตอร์โดยใส่คำสั่งนี้ใน bash
    ```
    cd <ชื่อโฟล์เดอร์ที่ต้องการ>
    ```
    ```
    git clone https://github.com/OteEnded/WebTechMidTermProject-Beats_Headphone.git
    ```
2.  (หากยังไม่ได้ตั้ง alias สำหรับคำสั่ง sail) ให้ กำหนด alias สำหรับคำสั่ง sail ลงใน .bashrc โดยใช้คำสั่งดังกล่าว แล้ว restart terminal
    ```
    echo "alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'" >> ~/.bashrc
    ```
3. Copy ไฟล์ .env.example ไปที่ .env โดยใช้คำสั่ง
    ```
    cp .env.example .env
    ```
4. สร้าง APP_KEY ใน .env โดยใช้คำสั่ง
   ```
   sail artisan key:generate
   ```
5. สร้าง และ start container โดยใช้คำสั่ง
    ```
    sail up -d
    ```
6. ติดตั้ง package ที่จำเป็นโดยใช้คำสั่ง
    ```
    sail npm install
    ```
    ```
    sail yarn install
    ```
7. run ตัว dev ขึ้นมาทำให้ css ใช้งานได้
    ```
    sail yarn dev
    ```
8. migrate และ seed ข้อมูลเข้าไปใน database โดยใช้คำสั่ง
    ```
    sail artisan migrate:fresh --seed
    ```
9. เข้าสู่หน้าเว็บที่ http://localhost ผ่าน browser เช่น Chrome, Firefox, Edge, Safari หรืออื่นๆ

---

## ตัวอย่าง User
| Email               | Password | Role       |
|---------------------|----------|------------|
| mute@example.com    | mute     | Customer   |
| smart@example.com   | smart    | Admin      |

* **Customer** คือลูกค้าที่ลงทะเบียนแล้ว สามารถสั่งซื้อเบเกอรี่ได้
* **Admin** คือคนดูแล สามารถสร้าง และจัดการเบเกอรี่ รวมถึงคำสั่งซื้อต่างๆ


---

## Contributors
<table>
<tr>
<td align="center">
    <a href = "https://github.com/xasterphere">
        <img src = "https://avatars.githubusercontent.com/u/98580340?v=4" width="50" height="50"/><br>
        <sub><b> xasterphere </b> </sub>
    </a>
    <br>
</td>

<td align="center">
    <a href = "https://github.com/zoneul">
        <img src = "https://avatars.githubusercontent.com/u/143541922?v=4" width="50" height="50"/><br>
        <sub><b> zoneul </b> </sub>
    </a>
    <br>
</td>

<td align="center">
    <a href = "https://github.com/NyxTheeranut">
        <img src = "https://avatars.githubusercontent.com/u/98580582?s=50" width="50" height="50"/><br>
        <sub><b> Nyx_Nyx </b> </sub>
    </a>
    <br>
</td>

<td align="center">
    <a href = "https://github.com/MeowKyWay">
        <img src = "https://avatars.githubusercontent.com/u/69355934?v=4" width="50" height="50"/><br>
        <sub><b> MeowKyWay </b> </sub>
    </a>
    <br>
</td>
</tr>
</table>

* **6410406584 ดุจรวี เหล่าอยู่คง**
* **6410401060 ธนภัทร เชื้อโตหลวง** 
* **6410406673 ธีรณัฏฐ์ สธนรักษ์** 
* **6410400993 กัญจน์ ศรีประไพ** 
---

## การเข้าถึงหน้าเว็บไซท์
### user
1. Home
    ```
    ใช้ดูหน้าหลัก ที่นำเสนอสินค้า
    ```
2. Products
    ```
    ใช้ดูสินค้าทั้งหมด
    ```
3. Custom Orders
    ```
    ใช้ดูสินค้าทั้งหมด แต่จะราคาถูกกว่า โดยมีส่วนลดเนื่องจากมีกำหนดขั้นต่ำในการสั้งซื้อ
    ```
4. Icon Cart
    ```
    ใช้ดูสินค้าทั้งหมด ที่เลือกใส่ตระกร้าไว้
    ```
5. Order History ใน drop down
    ```
    ใช้ดูรายการคำสั่งซื้อ ที่ได้ทำรายการไว้
    ```
6. Profile
    ```
    ใช้ดูข้อมูล และสามารถแก้ไขข้อมูลส่วนตัว
    ```
### admin
1. Orders
    ```
   ใช้ดูรายการคำสั่งซื้อทั้งหมด ที่ลูกค้าได้สั่งเข้ามา
    ```
2. Products
    ```
   ใช้ดูสินค้าทั้งหมด และสามารถเพิ่มแก้ไขหรือ ลบสินค้าได้อีกทั้งยังสามารถผูกกับวัตถุดิบได้อีกด้วย
    ```
3. Ingredients
    ```
   ใช้ดูวัตถุดิบทั้งหมด และสามารถเพิ่มแก้ไขหรือ ลบวัตถุดิบได้
    ```
4. Stocks
    ```
   ใช้ดูคลังสินค้าทั้งหมด และสามารถเพิ่มแก้ไขหรือ ลบของในคลังสินค้าได้
    ```
---
