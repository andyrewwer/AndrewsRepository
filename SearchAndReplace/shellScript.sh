#!/bin/bash


#tr
tempFile=''
#supporting Methods
copyBackToFile() { 
	cat $2 > $1 && rm $2 && cat $1
}

touchTempFile() { 
	touch $1
}


#-----------------------------------------------
#tr
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

#-----------------------------------------------
#sed
sedSubstitutionBasic() {
	someVar='This is a test test'
	echo $someVar
	echo $someVar | sed s/'test'/'proof'/	
	#output is This is a proof test #sed by default only catches the first instance on a given line
	echo $someVar | sed s/'test'/'proof'/g	
	#output is This is a proof proof #/g at the end is a param which makes it check each line

}

sedSubstitutionBasicFiles(){
	file=d5g9x9d8_LIMUN.sql
	tempFile=$(mktemp)
	# cat $file
	sed s/$1/$2/ < $file > tempFile && cat tempFile > $file && rm tempFile && cat $file	
	#where $1 is the string that will be found in $file and replaced with $2
}

#This catches the error but can only output the error code. Stops application from running
catchingExitCode() {
	cp $inputFile $outputFile
	if [ $? -ne 0 ] ;
	then
		echo -e "$YELLOW error in your request $NC"
		exit 1;
	fi
}

#-----------------------------------------------
#error Handling

#This catches the error, checks if the file is empty, then outputs the error. Stops application from running
catchingError() { 
	inputFile=$1
	outputFile=$2

	cp $inputFile $outputFile 2> someFile.txt
	if touch someFile.txt ;
	then
		echo -e "$YELLOW error: $RED" && cat someFile.txt && echo -e "$NC"
		rm someFile.txt
		exit 1;
	fi
}

#-----------------------------------------------
#Trapping error codes
function errorCopying {
    # re-start service
	echo -e "$YELLOW You are probably missing the source files which are being copied";
}
trap errorCopying EXIT


#-----------------------------------------------
#call A Function From another function
callFunctionFromAnotherFunction() {
	someVar="Andrew"
	echo "test" && anotherFunction $someVar
}

anotherFunction() {
	echo "Hello World" $1
}

#-----------------------------------------------
#main
main() {
	# sedSubstitutionBasic
	trTesting $1
	# callFunctionFromAnotherFunction
	# sedSubstitutionBasicFiles $1 $2 
}


main $1