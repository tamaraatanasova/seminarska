import time
import mysql.connector
from mfrc522 import SimpleMFRC522
from utils.sms_notifier import send_sms
from utils.email_notifier import send_email

# Подесување на RFID читачот
reader = SimpleMFRC522()

# Конекција со база на податоци
db = mysql.connector.connect(
    host="localhost",
    user="myappuser",
    password="mypassword",  # Сменете ја за вашиот environment
    database="rfid"
)

cursor = db.cursor()

def check_access(rfid_id):
    query = "SELECT * FROM users WHERE rfid_id = %s"
    cursor.execute(query, (rfid_id,))
    user = cursor.fetchone()

    if user:
        send_sms(user[1], f"Access granted for {user[2]}")  # SMS известување
        send_email(user[3], "Access granted", "Your access was granted.")
        return True
    else:
        send_sms("admin_phone_number", "Access attempt with invalid RFID.")
        return False

def main():
    while True:
        print("Place your RFID card...")
        rfid_id, text = reader.read()
        print(f"RFID ID: {rfid_id}")

        if check_access(rfid_id):
            print("Access granted.")
        else:
            print("Access denied.")
        time.sleep(1)

if __name__ == "__main__":
    main()
