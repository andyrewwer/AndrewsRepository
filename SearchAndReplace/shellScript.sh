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

sedSubstitutionBasic() {
	someVar='This is a test'
	echo $someVar
	echo $someVar | sed s/'test'/'proof'/	
}

sedSubstitutionBasicFiles(){
	file=d5g9x9d8_LIMUN.sql
	tempFile=$(mktemp)
	# cat $file
	sed s/$1/$2/ < $file > tempFile && cat tempFile > $file && rm tempFile && cat $file	
	#where $1 is the string that will be found and replaced with $2
}

addExtention() {
	someString=$1
	someString='$someString.txt'
	echo $someString
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

# sedSubstitutionBasicFiles $1 $2 

addExtention $1