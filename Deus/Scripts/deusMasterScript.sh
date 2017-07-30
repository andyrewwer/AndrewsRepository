YELLOW='\033[0;93m'
GREEN='\033[0;32m'
RED='\033[0;31m'
NC='\033[0m' # No Color


readDBChoices() {
	echo -e "Enter the conference name (should be same as DB name) [ENTER] $YELLOW"
	read newDB
	echo -e "$NC"
	
	if [ -z "$newDB" ]
	then
		echo -e "$RED There was an error in your request. Make sure you have an old and new DB $NC"
		echo
		readDBChoices
		return 2
	fi
	
	# echo $oldDB and $newDB
	
	printAllFileNames $oldDB $newDB
}


main() {

	readDBChoices 
	# deusRenameAllDB.sh
	# deusAutoConfigDBScript.sh
}

main 

