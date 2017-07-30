YELLOW='\033[0;93m'
GREEN='\033[0;32m'
RED='\033[0;31m'
NC='\033[0m' # No Color


renameConference(){
inputFile=Database/DeusTemplateDatabaseConfig.sql
outputFile=../Output/DBOutput/provisionedDB.sql
echo "Output file: $outputFile with crisisName: $1"
# cat $file
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

echo "Output file: $file with crisisName: $1"
echo "CrisisDirector: $2 withEmail: $3"

sed s/{{CRISIS_DIRECTOR_EMAIL}}/$3/ < $file > tempFile && cat tempFile > $file && rm tempFile
sed s/{{CRISIS_DIRECTOR_NAME}}/$2/ < $file > tempFile && cat tempFile > $file && rm tempFile
echo -e "$GREEN Successfully added Crisis Director: $2 with Email: $3 $NC"
echo
echo
}

readCrisisDirector() {
	echo -e "Enter the crisis director's first name and email and then press [ENTER] $YELLOW"
	read name email
	echo -e "$NC"
	
	if [ -z "$name" ]
	then
		echo -e "$RED There was an error in your request. Make sure you have a first name and email $NC"
		echo
		readCrisisDirector $1
		return 2
	fi
	if [ -z "$email" ]
	then
		echo -e "$RED There was an error in your request. Make sure you have a first name and email $NC"
		echo
		readCrisisDirector $1
		return 2
	fi
	
	# echo $name $email
	renameConference $1
	addCrisisDirector $1 $name $email
}

main() {
	readCrisisDirector $1
}

main $1

