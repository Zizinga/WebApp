'use strict';

// Create an observable stream from the search input keyup
var searchInput = document.querySelector('.my-search-input');
var searchResults = document.querySelector('.my-search-results');

var keyupStream = Rx.Observable.fromEvent(searchInput, 'keyup');

// Transform the stream into search results from the API
var searchStream = keyupStream.map(function (e) {
    return e.target.value;
}) // Get search text
    .debounce(250) // Debounce
    .distinctUntilChanged() // Only get changed search terms
    .flatMapLatest(function (term) {
        return fetch('https://www.omdbapi.com/?plot=short&r=json&t=' + term);
    }) // Request search results
    .flatMap(function (response) {
        return response.json();
    }); // Parse the json response

// Subscribe to the stream
searchStream.subscribe(function (data) {
    // Add search results to the DOM
    console.log(data);
    if (data.Response === "False") {
        searchResults.innerHTML = searchInput.value.length > 0 ? data.Error : '';
    } else {
        // Append search result to the DOM
        searchResults.innerHTML = '<li>' + data.Title + '</li>\n        <li>Released ' + data.Released + '</li>\n        <li>Rated ' + data.Rated + '</li>\n        <li>Plot Synopsis: ' + data.Plot + '</li>';
    }
});