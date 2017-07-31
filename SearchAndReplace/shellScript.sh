#!/bin/bash


#tr
tempFile=''
copyBackToFile() { 
	cat $2 > $1 && rm $2 && cat $1
}

touchTempFile() { 
	touch $1
}
toUpper() {
	tempFile='tempfile.txt'
	touchTempFile $tempFile
	cat $1 | tr 'a-z' 'A-Z' > $tempFile && copyBackToFile $1 $tempFile
}

toLower() {
	tempFile='tempfile.txt'
	touchTempFile $tempFile
	cat $1 | tr 'A-Z' 'a-z' > $tempFile && copyBackToFile $1 $tempFile
}

swapCase() {
	tempFile='tempfile.txt'
	touchTempFile $tempFile
	cat $1 | tr 'A-Za-z' 'a-zA-Z' > $tempFile && copyBackToFile $1 $tempFile
}

rot13() {
	tempFile='tempfile.txt'
	touchTempFile $tempFile
	cat $1 | tr 'A-MN-Za-mn-z' 'N-ZA-Mn-za-m' > $tempFile && copyBackToFile $1 $tempFile
}

addExtention() {
	someString=$1
	someString='$someString.txt'
	echo $someString
}

#sed
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
	#where $1 is the string that will be found in $file and replaced with $2
}

callFunctionFromAnotherFunction() {
	someVar="Andrew"
	echo "test" && anotherFunction $someVar
}

anotherFunction() {
	echo "Hello World" $1
}

trTesting() {
	echo "    Enter a number between 1 and 4.
	
1 - toUpper
2 - toLower
3 - swapCase
4 - rot13
"
	read -n 1 NUM 
	echo 
	echo
	case $NUM in
		1) toUpper $1;;
		2) toLower $1;;
		3) swapCase $1;;
		4) rot13 $1;;
		*) echo "INVALID NUMBER OOPS!" ;;
	esac
}

main() {
	trTesting $1
}

# sedSubstitutionBasicFiles $1 $2 

main $1