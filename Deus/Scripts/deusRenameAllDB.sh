BLUE='\033[0;34m'
GREEN='\033[0;32m'
RED='\033[0;31m'
NC='\033[0m' # No Color

forFileChangeDB() { 
		
inputFile=$1
outputFile=../Output/WebsiteOutput/${inputFile##*/}
originalConference='{{CONFERENCE_NAME}}'
renameConference=$2

tempFile=$(mktemp)

echo "Changing file: $inputFile to $outputFile from : $originalConference to: $renameConference"
cp $inputFile $outputFile
sed s:$originalConference:$renameConference: < $outputFile > tempFile && cat tempFile > $outputFile
echo cp $inputFile $outputFile
echo -e "$GREEN Successfully changed File: $inputFile to $outputFile from : $originalConference to: $renameConference $NC"
echo
echo
}

printAllFileNames() {
	for file in ../Coding/www/*; do
	  # echo $file
	  forFileChangeDB $file $1 $2
	done
}

readDBChoices() {
	echo -e "Enter the newDB name [ENTER] $BLUE"
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
}

main 

