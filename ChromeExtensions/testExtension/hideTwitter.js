// var element = document.querySelector('.ProfileTweet-actionCountForPresentation');
// element.parentElement.hide(element);

// $('.ProfileTweet-actionCountForPresentation').hide();


console.log('All ads have been removed.');

var toHide = document.getElementsByClassName('ProfileTweet-actionCountForPresentation');

for (var i = 0; i < toHide.length; i ++) {
    toHide[i].innerHTML = '';
}