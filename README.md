Build a simple application around the Github API. Design, internal structure, and application flow is completely up to you, if you want to include some advanced stuff feel free to do so. The usage of 3rd party libraries/frameworks is encouraged, and the assignment is preferably to be done in combination of Lumen / Laravel.

Please share the code with us once you are done. Feel free to commit as much as you feel is necessary.

Goals
1.	Architecture, fit for large scale projects
2.	Coding practices (documentation, testing, proper usage of git)
3.	Attention to details and thinking outside of the box
4.	Simplicity

Specification
The application should consist of 4 parts:
•	Sign up / in only with Github account
o	Send a welcome email to registered user.
o	Send an email notification when user is logged in.
	We noticed a new sign-in to your account from [Country] [IP]. Do you recognize this activity? [Yes, it was me] [No, secure account]. If the user choose [No, secure account], invalidate the user session / token.
	Example: https://storage.googleapis.com/support-forums-api/attachment/thread-36632370-1837968134165165671.png
•	The user details page should display user avatar, name, and company
o	Allow authenticated user to edit name and company details
•	User repos page should display a list of user repositories alongside with a number of open issues for each repo
•	Commit details for each repo (display as much info as possible)

API
Github API documentation can be found at: https://developer.github.com/v3/
•	Test user details endpoint: https://api.github.com/users/octocat
•	User repos: https://api.github.com/users/octocat/repos
•	Commit details: In response to user repos request

Potrebno je da se aplikacija uradi kao dodatni layer za Github API, odnosno da sva komunikacija prema Github API ide kroz Lumen / Laravel aplikaciju. Sto se tice izmene podataka, tu pricamo samo o izmeni podataka na aplikaciji, a ne na Github delu. 
