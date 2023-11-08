# Ozone-Bakery
Welcome to Ozone Bakery

## About
Website ร้านเบเกอรี่ที่มีทั้งระบบเลือกซื้อสินค้าแบบพร้อมขาย(Retail Order) และสินค้าสั่งทำ(Custom Order) โดยลูกค้าเข้ามารับสินค้าที่ร้านโดยตรงตามวันนัดรับที่ระบุไว้


---

## Setup
วิธีการติดตั้งโปรเจค
1. Clone โปรเจคนี้มาใว้บนคอมพิเตอร์โดยใส่คำสั่งนี้ใน bash

    ```
    cd <ชื่อโฟล์เดอร์ที่ต้องการ>
    ```
    ```
    git clone https://github.com/MeowKyWay/ozone-bakery-laravel.git
    ```

2.  (หากยังไม่ได้ตั้ง alias สำหรับคำสั่ง sail) ให้กำหนด alias สำหรับคำสั่ง sail ลงใน .bashrc โดยใช้คำสั่งดังกล่าว แล้ว restart terminal

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

* **Customer** คือลูกค้าที่ลงทะเบียนแล้ว สามารถสั่งซื้อสินค้าได้
* **Admin** คือคนดูแล สามารถสร้างและจัดการเบเกอรี่รวมถึงคำสั่งซื้อต่าง ๆ ได้


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

## การเข้าถึงหน้า Website
### User
1. Home
    
    ใช้ดูหน้าหลักที่นำเสนอสินค้า
    
2. Products
    
    ใช้ดูสินค้าทั้งหมด โดยมีการแบ่งประเภทสินค้าที่มีและไม่มีในคลัง
    
3. Custom Orders
    
    ใช้ดูสินค้าทั้งหมดและเลือกสั่งตามความต้องการ โดยมีส่วนลดเนื่องจากมีการกำหนดขั้นต่ำในการสั้งซื้อ
    
4. Shopping Cart Icon
    
    ใช้ดูสินค้าทั้งหมดที่เลือกใส่ตะกร้าไว้
    
5. Order History ใน drop down
    
    ใช้ดูรายการคำสั่งซื้อที่เคยทำรายการไว้
    
6. Profile
    
    ใช้ดูและแก้ไขข้อมูลส่วนตัว
    
### Admin
1. Orders
    
   ใช้ดูรายการคำสั่งซื้อทั้งหมดที่ลูกค้าสั่งเข้ามา
    
2. Products
    
   ใช้ดูสินค้าที่มีในร้านทั้งหมด และสามารถเพิ่ม แก้ไข และลบชนิดสินค้าได้ อีกทั้งยังสามารถดูและแก้ไขสูตรของสินค้าแต่ละชนิดได้
    
3. Ingredients
    
   ใช้ดูวัตถุดิบทั้งหมดพร้อมหน่วยปริมาณที่ใช้ และสามารถเพิ่ม แก้ไข และลบวัตถุดิบได้
    
4. Stocks
    
   ใช้ดูคลังสินค้าทั้งหมด และสามารถเพิ่ม แก้ไข หรือ ลบของสินค้าในคลังสินค้าได้
    
---
