YELLOW='\033[0;93m'
GREEN='\033[0;32m'
RED='\033[0;31m'
NC='\033[0m' # No Color

function errorCopying {

	echo -e "$YELLOW You are probably missing the source files which are being copied";
}

function finish {
	echo -e "$YELLOW Working";
	exit;
}

forFileChangeDB() { 
		
inputFile=$1
outputFile=../Output/WebsiteOutput/${inputFile##*/}
originalConference='{{CONFERENCE_NAME}}'
renameConference=$2

tempFile=$(mktemp)

# echo -e "Changing file: $inputFile to $outputFile from : $originalConference to: $renameConference $RED"
cp $inputFile $outputFile 2> someFile.txt
if touch someFile.txt ;
then
	sed s:../Output/WebsiteOutput/:: < someFile.txt > $tempFile && cat $tempFile > someFile.txt
	echo -e "$YELLOW error: $RED" && cat someFile.txt && echo -en "$NC"
	rm someFile.txt
	exit 21
fi
sed s:$originalConference:$renameConference: < $outputFile > tempFile && cat tempFile > $outputFile
# echo cp $inputFile $outputFile
echo -e "$GREEN Successfully changed File: $inputFile to $outputFile from : $originalConference to: $renameConference $NC"
echo
echo
}

#This catches the error but can only output the error code. Stops application from running
catchingExitCode() {
	cp $inputFile $outputFile
	if [ $? -ne 0 ] ;
	then
		echo -e "$YELLOW error in your request $NC"
		exit 21
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
		exit 21
	fi
}

printAllFileNames() {
	for file in ../Coding/www/*; do
	  # echo $file
	  forFileChangeDB $file $1
	done
}

main() {
	
	printAllFileNames $1
}

trap finish 2
trap errorCopying 21

main $1

# //Add error handling for no params - call masterscript
