BLUE='\033[0;34m'
GREEN='\033[0;32m'
RED='\033[0;31m'
NC='\033[0m' # No Color

forFileChangeDB() { 
		
file=$1
originalConference=$2
renameConference=$3
tempFile=$(mktemp)

echo "Changing file: $file from : $originalConference to: $renameConference"
sed s/$originalConference/$renameConference/ < $file > tempFile && cat tempFile > $file && rm tempFile
echo -e "$GREEN Successfully changed File: $file from : $originalConference to: $renameConference $NC"
echo
echo
}

printAllFileNames() {
	for file in ../Coding/www/*; do
	  echo $file
	  forFileChangeDB $file $1 $2
	done
}

readDBChoices() {
	echo -e "Enter the current and newDB name [ENTER] $BLUE"
	read oldDB newDB
	echo -e "$NC"
	
	if [ -z "$oldDB" ]
	then
		echo -e "$RED There was an error in your request. Make sure you have an old and new DB $NC"
		echo
		readDBChoices
		return 2
	fi
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
}

main 

