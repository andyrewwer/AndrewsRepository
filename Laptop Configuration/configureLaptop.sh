#installing & updating Brew

echo

if hash brew 2>/dev/null; then
  echo "Homebrew is already installed!"
else
  echo "Installing Homebrew..."
  ruby -e "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/master/install)"
fi

echo
echo "Ensuring you have the latest Homebrew..."
brew update

echo
echo "Ensuring your Homebrew directory is writable..."
sudo chown -R $(whoami) /usr/local/bin

echo
echo "Installing Homebrew services..."
brew tap homebrew/services

echo
echo "Upgrading existing brews..."
brew upgrade

echo "Cleaning up your Homebrew installation..."
brew cleanup

echo
echo "Adding Homebrew's sbin to your PATH..."
echo 'export PATH="/usr/local/sbin:$PATH"' >> ~/.bash_profile

#Here we are adding github, duet, 

echo
echo "Installing Git and associated tools"
brew install git
brew tap git-duet/tap
brew install git-duet

brew cask install github-desktop
brew cask install rowanj-gitx
brew cask install sourcetree

#Here we are installing java + intellij + maven etc

echo
echo "Installing Java Development tools"
brew cask install java
brew cask install intellij-idea
brew install maven
brew install gradle
brew install springboot

#NodeJs

echo
echo "Installing NodeJS"

brew install node

#Ruby 

echo
echo "Installing Ruby tools and Ruby 2.3.1"
cp files/.irbrc ~/.irbrc
brew install readline
eval "$(rbenv init -)"
rbenv install 2.3.1 --skip-existing
rbenv global 2.3.1
gem install bundler
rbenv rehash

brew cask install rubymine


# hide the dock
defaults write com.apple.dock autohide -bool true
killall Dock

# fast key repeat rate, requires reboot to take effect
defaults write ~/Library/Preferences/.GlobalPreferences KeyRepeat -int 1
defaults write ~/Library/Preferences/.GlobalPreferences InitialKeyRepeat -int 15

# set finder to display full path in title bar
defaults write com.apple.finder '_FXShowPosixPathInTitle' -bool true

# stop Photos from opening automatically
defaults -currentHost write com.apple.ImageCapture disableHotPlug -bool true