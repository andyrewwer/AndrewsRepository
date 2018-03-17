#!/usr/bin/env bash
YELLOW='\033[0;93m'
BYELLOW="\033[1;33]"
GREEN='\033[0;32m'
RED='\033[0;31m'
BOLDRED="\033[1;31m"
BLUE='\033[0;34m'
CYAN='\033[0;36m'
NC='\033[0m' # No Color
userChoice=''

function signalInterrupted {
	echo -e "$BOLDRED OK then, if you're sure you want to leave . . . Bye! :(";
	read -n1 test
	echo -e "$BOLDRED OK then, if you're sure you want to leave . . . Bye! :(";
	exit;
}


createOutputOrExit() {
	if [ "$userChoice" = '' ]
	then
		read -n1 createOutput
		createOutput=$( echo $createOutput | tr 'A-Z' 'a-z' )
	fi
	#makesInputLowerCase

	#Checks If Yes
	if [ "$userChoice" = "y" ] | [ "$createOutput" = "y" ]
	then
		echo -e "$CYAN OK I am now creating $1"
		userChoice=$createOutput
		mkdir -p ../Output/WebsiteOutput
		touch $1
	#Checks If No
	elif [ "$userChoice" = "n" ]
	then
		echo -e "$RED OK . . . Shuting myself off then :("
		exit 1
	#If not Yes or No, asks again. Up to 5 times
	elif [[ $count = 5 ]]
	then
		echo -e "$RED OK, I don't think you're really trying. Shutting myself off now."
		exit 1
	else
		count=$((count+1))
		echo $createdOutput
		echo -e "$RED I'm sorry you didn't enter valid input :( \n $YELLOW Would you like me to create it for you? (Y/N)  $NC"
		echo
		createOutputOrExit
		return
	fi
}

forFileChangeDB() { 
		
inputFile=$1
outputFile=../Output/WebsiteOutput/${inputFile##*/}

if [ ! -e "$outputFile" ] ;
then
	if [ "$userChoice" = '' ]
	then
		echo -e "$YELLOW Sorry your output file does not exist, would you like me to create it for you? (Y/N) $NC"
	fi
	createOutputOrExit $outputFile
fi


originalConference='{{CONFERENCE_NAME}}'
renameConference=$2

tempFile=$(mktemp)

# echo -e "Changing file: $inputFile to $outputFile from : $originalConference to: $renameConference $RED"
cp $inputFile $outputFile 2> someFile.txt
if [ -z "someFile.txt" ] ;
then
	sed s:../Output/WebsiteOutput/:: < someFile.txt > $tempFile && cat $tempFile > someFile.txt
	echo -e "$YELLOW error: $RED" && cat someFile.txt && echo -en "$NC"
	rm someFile.txt
	echo -e "$BYELLOW You are probably missing the source files which are being copied"
	exit 1
fi
sed s:$originalConference:$renameConference: < $outputFile > tempFile && cat tempFile > $outputFile
# echo cp $inputFile $outputFile
echo -e "$GREEN Successfully added Conference $renameConference to file: $outputFile $NC"
echo
echo
}

#This catches the error but can only output the error code. Stops application from running
catchingExitCode() {
	cp $inputFile $outputFile
	if [ $? -ne 0 ] ;
	then
		echo -e "$YELLOW error in your request $NC"
		exit 1
	fi
}


#This catches the error, checks if the file is empty, then outputs the error. Stops application from running
catchingError() {
	inputFile=$1
	outputFile=../Output/WebsiteOutput/$inputFile

	cp $inputFile $outputFile 2> someFile.txt
	if touch someFile.txt ;
	then
		echo -e "$YELLOW error: $RED" && cat someFile.txt && echo -e "$NC"
		rm someFile.txt
		exit 1
	fi
}

printAllFileNames() {
	for file in ../Coding/www/*; do
		if [ ! -e $file ]
		then
			echo -e "$YELLOW Sorry that directory is empty, please create ../Coding/www $NC"
			rm someFile.txt
			exit 1
		fi
	  # echo $file
	  forFileChangeDB $file $1
	done
}

main() {
	if [ -z "$1" ]; then
		echo -e "$YELLOW No input found. Expected 1, found 0 $NC"
		./deusMasterScript.sh
		return;
	fi
	printAllFileNames $1
}

main $1

