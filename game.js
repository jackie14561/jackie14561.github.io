

var lowerLimit = 1
var upperLimit = 100;
var answer = Math.floor((Math.random() * 100)+1);
var guess = '';
var message = 'Guess a number between ' + lowerLimit + ' and ' + upperLimit + ':';

// Keep prompting the user for a guess until the game ends.
while (true) {
    // Prompt the user for a guess.
    guess = prompt(message, guess);
    
    // If the cancel button was pushed, let the user know the game is ending and
    // break out of the loop.
    if (guess == null) {
        alert('Quitting game now.');
        break;
    }
    // If the guess is a number...
    else if (isFinite(guess) && guess != '') {
        // Make sure the guess is converted into a number.
        guess = +guess;
        
        // If the guess is less than the range let the user know.
        if (guess < lowerLimit) {
            document.write("Your guess should be no less than " + lowerLimit + ".");
        }
        // If the guess is greater than the range let the user know.
        else if (guess > upperLimit) {
            document.write("Your guess should be no greater than " + upperLimit + ".'");
        }
        // If the guess is too high let the user know.
        else if (guess > answer) {
            document.write("Sorry you are wrong. Your guess of "+ guess + " is too high.<br>");
        }
        // If the guess is too low let the user know.
        else if (guess < answer) {
            document.write("Sorry you are wrong.Your guess of "+ guess + " is too low. <br/>");
        }
        // If none of the other cases were true that means the answer must have
        // been guessed so let the user know and break out of the loop.
        else {
            document.write("Great job, you got it!");
			var q=prompt('Would you like to play again?', '');
			if (q=='no')
            break;
        }
    }
    // If the guess is not a number, let the user know.
    else {
        alert('You must enter a number as a guess.');
    }
    
    
}

