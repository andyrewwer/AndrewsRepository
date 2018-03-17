#!/usr/bin/env bash
YELLOW='\033[0;93m'
GREEN='\033[0;32m'
RED='\033[0;31m'
NC='\033[0m' # No Color

function signalInterrupted {
	echo -e "$BOLDRED OK then, if you're sure you want to leave . . . Bye! :(";
	read -n1
	exit;
}

readDBChoices() {
	echo -e "Enter the conference name (should be same as DB name) [ENTER] $YELLOW"
	read -e newDB
	echo -e "$NC"
	
	if [ -z "$newDB" ]
	then
		echo -e "$RED There was an error in your request. Make sure you have an old and new DB $NC"
		echo
		readDBChoices
		return 
	fi
	
	# echo $oldDB and $newDB
	./deusRenameAllDB.sh $newDB
	readCrisisDirector $newDB
}

readCrisisDirector() {
	echo -e "Enter the crisis director's first name and email and then press [ENTER] $YELLOW"
	read -e name email
	echo -e "$NC"
	
	if [ -z "$email" ]
	then
		echo -e "$RED There was an error in your request. Make sure you have a first name and email $NC"
		echo
		readCrisisDirector $1
		return
	fi
	
	# echo $name $email
	./deusAutoConfigDBScript.sh $1 $name $email
}


main() {

	if [ -z "$1" ]
	then
		readDBChoices 
		return
	fi
	
	./deusRenameAllDB.sh $1
	
	if [ -z "$2" ]
	then
		if [ -z "$1" ]
		then
			readCrisisDirector $1	 
			return
		fi
	fi
	
	./deusAutoConfigDBScript.sh $1 $2 $3
}

main $1 $2 $3

