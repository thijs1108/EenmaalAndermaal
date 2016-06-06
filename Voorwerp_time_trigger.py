import requests
import time

while True:
    r = requests.get("http://localhost/EenmaalAndermaal/checks/check_voorwerpen_verstreken.php")
    print(r.text, end="")
    time.sleep(1)
