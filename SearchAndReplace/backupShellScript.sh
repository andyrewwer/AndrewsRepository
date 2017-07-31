#!/bin/bash


callFunctionFromAnotherFunction() {
	echo $1
	tempFile=temporaryFile.txt
	touch $tempFile
	cat $1 | tr '[:lower:][:upper:]' '[:upper:][:lower:]' > $tempFile && anotherFunction $1 $tempFile
	
	
	# cat $1 | tr 'a-zA-Z' 'A-Za-z' > tempFile && anotherFunction $1 $tempFile
	echo "it worked?"
}

anotherFunction() {
	cat $2 > $1 && rm $2 && cat $1
}

callFunctionFromAnotherFunction "test.txt"


