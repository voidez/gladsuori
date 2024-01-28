shit work for shit ministry

dbmain architecture ![photo_1_2024-01-28_19-17-37](https://github.com/voidez/gladsuori/assets/47336690/361cec13-4a4f-48cc-b226-6eab98281db4)
accounts table keys ![photo_5_2024-01-28_19-17-37](https://github.com/voidez/gladsuori/assets/47336690/74bfb410-443f-42a4-97d3-7a18fbc89f82)
reviews table keys ![photo_2_2024-01-28_19-17-37](https://github.com/voidez/gladsuori/assets/47336690/5c03fbf9-9430-4e3e-9526-6f9691933812)

accounts and reviews requires ID incrementing.

it can be done by requesting in MySQL
ALTER TABLE accounts MODIFY id INT NOT NULL AUTO_INCREMENT;
ALTER TABLE reviews MODIFY id INT NOT NULL AUTO_INCREMENT;
