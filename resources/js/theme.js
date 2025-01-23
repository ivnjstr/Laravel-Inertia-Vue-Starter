
//1. Set the theme when the page loads 
function setThemeOnLoad(){
    if ( // means if this logic returns true
        localStorage.theme === "dark" ||
        (!("theme" in localStorage) && window.matchMedia("(prefers-color-scheme: dark)").matches)

        // first condition take a look at the local storage if there is a dark in local storage
        // second using "or / ||" means or there is no theme at all and the windows match media basically the system prefference of a user is dark then we want to set the whole website to a dark mode
        // refference tailwind.com darkmode spaghetti.js
    ) {
        document.documentElement.classList.add("dark");
    } else {
        document.documentElement.classList.remove("dark");
    }
}


//2. Change the theme when we click on this
// another function which attached to that button // remember this is on button click
function switchTheme(){ 
    if ( // means if this logic returns true
        localStorage.theme === "dark" ||
        (!("theme" in localStorage) && window.matchMedia("(prefers-color-scheme: dark)").matches)

        // first condition take a look at the local storage if there is a dark in local storage
        // second using "or / ||" means or there is no theme at all and the windows match media basically the system prefference of a user is dark then we want to set the whole website to a dark mode
        // refference tailwind.com darkmode spaghetti.js
    ) {
        document.documentElement.classList.remove("dark");
        // also in the localStorage add theme key light
        localStorage.theme = "light"
    } else {
        document.documentElement.classList.add("dark");
        localStorage.theme = "dark"
    }
}

//Now we have a function then export them so we can use them elsewhere
export{setThemeOnLoad, switchTheme};

//call setThemeOnLoad when the application Load that means in our app.js