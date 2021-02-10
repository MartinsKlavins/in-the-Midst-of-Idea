### What is it
* Wireless stage lighting fixture, which works in WiFi 2.4GHz network, and for control uses Art-Net.
* It is completely wireless, it has bulit-in battery.
* It’s cube shaped –  4cm by 4cm. Made as small as possible, that is why there is no interface ( almost no buttons ).
* Device setup has to be done with it’s webserver. In other words – fixture’s interface is webserver, from there you can set up Art-Net and DMX512 settings for each induvidual fixture.
* It has some functions ( apart from DMX512 usual functions/effects ) – Sleep Mode, RSSI – Received Signal Strength Indicator. Also possible to view last octet of an IP address, DMX address and universe on device LED’s.
* Fixture has real-time configuration possibility ( similar to RDM protocol ) from it’s webserver.

### How it’s made
* MCU and power management – Wemos D1 mini (ESP8266) with it’s compatible battery shield (TP5410).
* Light source – WS2812 addresdable LED’s with 60º lens.
* Battery – 750mAh Li-Po.
