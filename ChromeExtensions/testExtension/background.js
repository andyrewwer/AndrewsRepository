// background.js

// Called when the user clicks on the browser action.
chrome.browserAction.onClicked.addListener(function() {
    // Send a message to the active tab
    console.log("hmmm, I wish!");
    chrome.tabs.query({active: true, currentWindow: true}, function(tabs) {
        var activeTab = tabs[0];
        chrome.tabs.sendMessage(activeTab.id, {"refresh": "true"});
    });
});

chrome.mouseEvent.addEventListener(function() {
    chrome.tabs.query({active: true, currentWindow: true}, function(tabs) {
        var activeTab = tabs[0];
        chrome.tabs.sendMessage(activeTab.id, {"refresh": "true"});
    });
}, false);

