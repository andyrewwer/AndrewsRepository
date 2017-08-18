// var element = document.querySelector('.ProfileTweet-actionCountForPresentation');
// element.parentElement.hide(element);

// $('.ProfileTweet-actionCountForPresentation').hide();


function hideAllTwitter() {
    console.log('running');

    var twitterNumbersEtc = document.getElementsByClassName('ProfileTweet-actionCount');
    var twitterPersonAlsoLiked = document.getElementsByClassName('tweet-context');

    console.log(document);
    console.log("Count2: " + twitterPersonAlsoLiked.length);
    console.log("");
    for (var i = 0; i < twitterNumbersEtc.length; i++) {
        twitterNumbersEtc[i].innerHTML = '';
    }
    for (var i = 0; i < twitterPersonAlsoLiked.length; i++) {
        twitterPersonAlsoLiked[i].innerHTML = '';
    }
}

document.addEventListener("scroll", function () {
    console.log("scroll");
   hideAllTwitter();
});

hideAllTwitter();
setTimeout(hideAllTwitter, 3000); // instead of this does when Ajax runs - would also replace above event listener

// https://stackoverflow.com/questions/3489433/monitor-all-javascript-events-in-the-browser-console
// https://www.w3.org/TR/DOM-Level-2-Events/events.html#Events-eventgroupings-mutationevents


// Toggle on / off (each social media - refresh)
// Get rid of promoted
// When you scroll, still deletes.
