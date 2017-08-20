#!/usr/bin/env bash
YELLOW='\033[0;93m'
BYELLOW="\033[1;33m"
GREEN='\033[0;32m'
RED='\033[0;31m'
BOLDRED="\033[1;31m"
BLUE='\033[0;34m'
CYAN='\033[0;36m'
NC='\033[0m' # No Color
count=0

function signalInterrupted {
	echo -e "$BOLDRED OK then, if you're sure you want to leave . . . Bye! :(";
	read -n1
	exit;
}

createOutputOrExit() {
	read -n1 createOutput

	#makesInputLowerCase
	createOutput=$( echo $createOutput | tr 'A-Z' 'a-z' )

	#Checks If Yes
	if [ "$createOutput" = "y" ]
	then
		echo -e "$CYAN OK I am now creating ../Output/DBOutput/provisionedDB.sql"
		mkdir -p ../Output/DBOutput
		touch ../Output/DBOutput/provisionedDB.sql;
	#Checks If No
	elif [ "$createOutput" = "n" ]
	then
		echo -e "$RED OK . . . Shuting myself off then :("
		exit 1
	#If not Yes or No, asks again. Up to 5 times
	elif [ $count = 5 ]
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

renameConference(){
inputFile=Database/DeusTemplateDatabaseConfig.sql

outputFile=../Output/DBOutput/provisionedDB.sql

cat $inputFile 2> someFile.txt

if [ ! -e "someFile.txt" ] ;
then
	echo -e "$YELLOW error: $RED" && cat someFile.txt && echo -en "$NC"
	rm someFile.txt
	echo -e "$BYELLOW You are probably missing the source files which are being copied $NC";
	exit 1
fi

if [ ! -e "$outputFile" ] ;
then
	echo -e "$YELLOW Sorry your output file does not exist, would you like me to create it for you? (Y/N) $NC"
	createOutputOrExit
fi

# echo "Output file: $outputFile with crisisName: $1"
sed s/{{CONFERENCE_NAME}}/$1/ < $inputFile > $outputFile
echo -e "$GREEN Successfully create: $output with Crisis Name: $1 $NC"
#where $1 is the string that will be found and replaced with $2
}

addCrisisDirector(){
renameConference $1
file=../Output/DBOutput/provisionedDB.sql
#forName
#forEmail

tempFile=$(mktemp)

# echo "Output file: $file with crisisName: $1"
# echo "CrisisDirector: $2 withEmail: $3"

sed s/{{CRISIS_DIRECTOR_EMAIL}}/$3/ < $file > tempFile && cat tempFile > $file && rm tempFile
sed s/{{CRISIS_DIRECTOR_NAME}}/$2/ < $file > tempFile && cat tempFile > $file && rm tempFile
echo -e "$GREEN Successfully added Crisis Director: $2 with Email: $3 $NC"
echo
echo
}

main() {
	if [ -z "$3" ]; then
		echo -e "$YELLOW No input found. Expected 3, found less $NC"
		deusMasterScript.sh
		return;
	fi

	renameConference $1
	addCrisisDirector $1 $2 $3
}

trap signalInterrupted 2

main $1 $2 $3

