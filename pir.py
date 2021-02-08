import RPi.GPIO as GPIO
import time
import os

GPIO.setmode(GPIO.BOARD)
PIR_PIN = 11
GPIO.setup(PIR_PIN, GPIO.IN)
state = "HIGH"
state2 = "HIGH"

def KUSTIBA(PIR_PIN):
    global state, state2
    if state == "HIGH":
        state = "LOW"
        print ("Kustiba")
        os.system('omxplayer -o local 320.mp3')
        time.sleep(2)
        print("no if in def")
        print(state)
        state2 = "LOW"
        
print ("PIR test")
time.sleep(2)

try:
    GPIO.add_event_detect(PIR_PIN, GPIO.RISING, callback=KUSTIBA, bouncetime=100)
    while 1:
        time.sleep(10)
        if state == state2:
            state = "HIGH"
            state2 = "HIGH"
            


except KeyboardInterrupt:
    print ("exit")
    GPIO.cleanup()
