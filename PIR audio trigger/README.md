### Working principles
* Start audio file when motion is detected.
* Then audio starts, it has to play till end. No interruptions, no starting over if motion is detected during playback.

### Technical notes
* Be careful with GPIO library (there are two modes – BCM and BOARD).
* There is installed and used ”omxplayer” for audio playing.
* Interesting fact about Python language – if you want to use global variable in function, you have to declare it as “global” in each function. Take look at “state” and “state2” in code.
* Take a notice – Python script and audio file has to be in same directory.
