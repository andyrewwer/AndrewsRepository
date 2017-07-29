#!/bin/bash

toUpper() {
	tempFile=$(mktemp)
	cat $1 | tr 'a-z' 'A-Z' > tempFile && cat tempFile > $1 && rm tempFile && cat $1
}

toLower() {
	tempFile=$(mktemp)
	cat $1 | tr 'A-Z' 'a-z' > tempFile && cat tempFile > $1 && rm tempFile && cat $1
}

swapCase() {
	tempFile=$(mktemp)
	cat $1 | tr 'A-Za-z' 'a-zA-Z' > tempFile && cat tempFile > $1 && rm tempFile && cat $1	
}

rot13() {
	tempFile=$(mktemp)
	cat $1 | tr 'A-MN-Za-mn-z' 'N-ZA-Mn-za-m' > tempFile && cat tempFile > $1 && rm tempFile && cat $1	
}

sendTests() {
	someVar='I wish this Andrew was consistent with his casing'
	file=test.txt
	somevar= sed /T/d $file
}

readTests() {
	echo "Hello, "$USER".  This script will register you in Michel's friends database."

	# echo -n "Enter your name and press [ENTER]: "
# 	#-n removes the new line at the end
# 	read name
# 	#read name, read with variable name
# 	echo -n "Enter your gender and press [ENTER]: "
# 	read -n 1 gender
# 	#-n -1 means it only waits for -{number} characters
#
	echo -n "Enter the CD's first name and email [ENTER]: "
	read name email
	
	echo $name $email

	echo "$name" "$gender"

}

main() {
	echo "    Enter a number between 1 and 4.
	
1 - toUpper
2 - toLower
3 - swapCase
4 - rot13
"
	read NUM
	case $NUM in
		1) toUpper $1;;
		2) toLower $1;;
		3) swapCase $1;;
		4) rot13 $1;;
		*) echo "INVALID NUMBER OOPS!" ;;
	esac
}

readTests