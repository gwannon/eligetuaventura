#!/bin/bash

#resize mp3

FILES="*.mp3"

for F in $FILES

do
newname=`basename "$F" -new.mp3`
echo $newname
ffmpeg -i "$F" -acodec libmp3lame -ac 2 -ab 32k -ar 44100 "$newname.mp3"

done
