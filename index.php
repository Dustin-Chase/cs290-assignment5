<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
			<link rel="stylesheet" type="text/css" href="style.css">
			<script type="text/javascript" src="testAPI.js"></script>
		<title>How-To Guide for OMDb API</title>		
	</head>
	<body>
		<h1>A How-To for Using OMDb's Web API</h1>
		<p>by Dustin Chase</p>
		<div>
			<ul id="menu">
				<li><a href="#about">About</a></li>
				<li><a href="#searches">Types of Searches</a></li>
				<li><a href="#parameters">Search Parameters</a></li>
				<li><a href="#example">A Cool Example</a></li>				
			</ul>
		</div>
		
		<a name="about">
		<h2>About the Guide</h2>
		<p>The OMDb API is a free web service to obtain movie information. This guide explains how to use 
		this API. The OMDb has a lot of information available such as the movie's year of release, runtime, director, writer, poster (sometimes)
		and plot summary. In this guide we will look at the types of searches you can do and what sorts of data these searches return.</p>
		
		<p>The code examples use JavaScript/AJAX like this: 
		<br>
		<div id="code">
			<code>
			httpRequest.open("GET", "http://www.omdbapi.com/?s=airplane", true)
			</code>
		</div>
		<br>
		
		so we don't have to reload the page after we request results. If you need to learn how to use AJAX you can go <a href="http://www.w3schools.com/ajax/">here,</a> but this could also be done with PHP.</p>
		
		<h4>But wait...Do I need an API key?</h4>
		<p>No, but the site's curator (or whatever you call "dude who runs the show") will soon add this requirement. In the mean time, expect to see slow responses sometimes and some 503 errors as the site deals with bots and other 
			internet unpleasantness.</p>
		
		<a name="searches">
		<h2>Types of OMDb Searches</h2>
		<p>The website supports two types of searches: 
			<ul>
				<li>By ID or Title</li>
				<li>By Search</li>
			</ul>
		</p>
		
		<p> The search by ID or Title option allows you to search by title (yep) or by IMDB identification number. Conducting a search by title with the title "Airplane" like this
		<div id="code">
			<code>
			http://www.omdbapi.com/?t=airplane&plot=short&r=json
			</code>
		</div>
		<br>
		returns this result: 
		<br>
		<div id="code">
			<code>
			{"Title":"Airplane","Year":"1999","Rated":"N/A","Released":"15 Aug 1999","Runtime":"60 min","Genre":"Action, Comedy, Sci-Fi","Director":"Josh Pate","Writer":"Josh Pate",
			"Actors":"Clayton Rohner, Richard Brooks, Googy Gress, Marshall Bell","Plot":"N/A","Language":"N/A","Country":"N/A","Awards":"N/A",
			"Poster":"http://ia.media-imdb.com/images/M/MV5BMTgzNTIwMDA0M15BMl5BanBnXkFtZTcwMzk0ODM3Mw@@._V1_SX300.jpg","Metascore":"N/A","imdbRating":"7.4","imdbVotes":"11",
			"imdbID":"tt0584812","Type":"episode","Response":"True"}
			</code>
		</div>
		<br>
		If you were looking for the comedy satire Airplane! you would probably be disappointed in this result since this refers to an episode of a television show that was released about 20 years
		after the movie. You'll get better results if you know the release year: 
		<br>
		<div id="code">
			<code>
			http://www.omdbapi.com/?t=airplane&y=1980&plot=short&r=json
			</code>
		</div>
		<br>
		Which gives the right data:
		<br>
		<div id="code">
			<code>
			 {"Title":"Airplane!","Year":"1980","Rated":"PG","Released":"02 Jul 1980","Runtime":"88 min","Genre":"Comedy","Director":"Jim Abrahams, David Zucker, Jerry Zucker",
			"Writer":"Jim Abrahams (written for the screen by), David Zucker (written for the screen by), Jerry Zucker (written for the screen by)",
			"Actors":"Kareem Abdul-Jabbar, Lloyd Bridges, Peter Graves, Julie Hagerty","Plot":"An airplane crew takes ill. Surely the only person capable of 
			landing the plane is an ex-pilot afraid to fly. But don't call him Shirley.","Language":"English","Country":"USA","Awards":"Nominated for 1 Golden Globe. 
			Another 2 wins & 5 nominations.","Poster":"http://ia.media-imdb.com/images/M/MV5BNDU2MjE4MTcwNl5BMl5BanBnXkFtZTgwNDExOTMxMDE@._V1_SX300.jpg","Metascore":"N/A",
			"imdbRating":"7.8","imdbVotes":"137,289","imdbID":"tt0080339","Type":"movie","Response":"True"}
			</code> 
		</div>
		<br>
		
		or you could cast a broader net with the 'By Search' option. This allows you to just enter a movie title <br>
		<div id="code">
			<code> 
			http://www.omdbapi.com/?s=airplane
			</code>
		</div>
		<br>
		and it finds rows with similar titles:
		</br>
		<div id="code">
			<code>
			 {"Search":[{"Title":"Airplane!","Year":"1980","imdbID":"tt0080339","Type":"movie"},{"Title":"Airplane II: The Sequel","Year":"1982","imdbID":"tt0083530","Type":"movie"},
			 {"Title":"Airplane vs Volcano","Year":"2014","imdbID":"tt3417334","Type":"movie"},{"Title":"Mr. Monk and the Airplane","Year":"2002","imdbID":"tt0650624","Type":"episode"},
			 {"Title":"Paper Airplane","Year":"2013","imdbID":"tt2669744","Type":"episode"},{"Title":"Airplane Repo","Year":"2010–","imdbID":"tt1808720","Type":"series"},
			 {"Title":"Fly Jefferson Airplane","Year":"2004","imdbID":"tt0427256","Type":"movie"},{"Title":"Love Is in the Airplane","Year":"2005","imdbID":"tt0748823","Type":"episode"},
			 {"Title":"Airplane on Conveyor Belt","Year":"2008","imdbID":"tt1177693","Type":"episode"},{"Title":"Airplane Hour","Year":"2007","imdbID":"tt1157191","Type":"episode"}]}
			</code>
		</div>
		</p>
		<a name="parameters">
		<h2>Search Parameters</h2>
		<p>Now that we've seen the search types and the whole chunks of data we get back, let's look at the individual search parameters and how they are used.</p>
		<h4>By ID or Title</h4>
		<h6>i, t</h6>
		<p>The API tells us that both i and t are optional, but that at least one argument is required. With no arguments, our search crashes and burns so it's a good idea
			to have either the title or IMDB identification number in there.</p>
		
		<p>We've seen what happens if we enter a title by itself. The results are a little unpredictable if we are searching by title and no have no other information. 
		 What happens in the title field is blank? We get back <code>{"Response":"False","Error":"Object reference not set to an instance of an object."}</code>! So you will want
		 to make sure you don't have empty search fields when you submit your request. </p>
		 
		 <p>If we search by ID while using an invalid number we get back a more useful response. Submitting the search <code>httpRequest.open("GET", "http://www.omdbapi.com/?i=12345", true)</code> 
		 gives us back <code> {"Response":"False","Error":"Incorrect IMDb ID"}</code>. A highly useful reply that we can use to alert the user.</p>
		
		<h6>type</h6>
		<p>Type is a really useful parameter to narrow down your search. Suppose we search for "Where the Wild Things Are." by title: 
		<code>http://www.omdbapi.com/?t=Where+the+Wild+Things+Are&y=&plot=short&r=json</code> That returns the most likely suspect: The 2009 movie. But there is 
		also an episode of Buffy the Vampire Slayer by the same name. Trying to find that episode in the database turns out to be kind of tricky. Suppose you submit 
		<code>httpRequest.open("GET", "http://www.omdbapi.com/?t='where the wild things are'&type=episode", true);</code>. Suprisingly, you get back 
		<div id="code">
		<code> {"Title":"The Mob Reviews: 'Where the Wild Things Are' and 'Law Abiding Citizen'","Year":"2009","Rated":"N/A","Released":"17 Oct 2009","Runtime":"30 min","Genre":"Reality-TV, Talk-Show",
		"Director":"N/A","Writer":"N/A","Actors":"Megan Albertus, Angie Griffin, Andre Meadows, Chad Nikolaus","Plot":"N/A","Language":"N/A","Country":"N/A","Awards":"N/A","Poster":"N/A",
		"Metascore":"N/A","imdbRating":"N/A","imdbVotes":"N/A","imdbID":"tt1535247","Type":"episode","Response":"True"}</code>
		</div>
		<p>No one seems to care much about this show since there is so much missing information. To get the Buffy episode, we want to use the search 
		<code>httpRequest.open("GET", "http://www.omdbapi.com/?t=where+the+wild+things+are&type=episode", true);</code> </p>
		<p>Now we get: </p>
		<div id="code"> 
		<code> {"Title":"Where the Wild Things Are","Year":"2000","Rated":"TV-PG","Released":"25 Apr 2000","Runtime":"60 min","Genre":"Action, Drama, Fantasy","Director":"David Solomon","Writer":
		"Joss Whedon (creator), Tracey Forbes","Actors":"Sarah Michelle Gellar, Nicholas Brendon, Alyson Hannigan, Marc Blucas","Plot":"Buffy and Riley's passionate lovemaking energizes supernatural
		elements inside a frat house.","Language":"English","Country":"USA","Awards":"N/A","Poster":"http://ia.media-imdb.com/images/M/MV5BMjA5MTczMzY4N15BMl5BanBnXkFtZTYwMzE4NDk5._V1_SX300.jpg",
		"Metascore":"N/A","imdbRating":"5.9","imdbVotes":"815","imdbID":"tt0533524","Type":"episode","Response":"True"}</code>
		</div>
		<p>When you designing your search interface, you will have to decide which format to use for the title strings. The results are quite different depending which method you use. </p>
		
		<h6>y, v</h6>
		<p>The year of release parameter isn't terribly interesting. The API version parameter is still reserved for future use. </p>
		<h6>r</h6>
		<p>The type of data you want to return will depend on your particular application. Click <a href="http://www.json.org/xml.html">here</a> for an explanation of JSON vs. XML response types (quite biased toward JSON of course). There is also 
		<a href="http://stackoverflow.com/questions/5615352/xml-and-json-advantages-and-disadvantages">this</a> discussion of how XML might work better for your application. </p>
		<h6>tomatoes</h6>
		<p>Our last parameter in the search by title/ID is the Rotten Tomatoes rating. You can leave this out and it won't hurt anything.</p>
		<h6>callback</h6>
		<p>Click <a href="http://json-jsonp-tutorial.craic.com/index.html">here</a> for a great explanation of JSON callbacks.</p>
		
		<h4>By Search</h4>
		<h6>i, t</h6>
		<p>This search type and parameters are really useful if you aren't sure what you are looking for, but do we have the same kinds of search formatting issues with titles as before? Let's try this search:
		<code>httpRequest.open("GET", "http://www.omdbapi.com/?s=where+the+wild+things+are&type=episode", true);</code> This search turns up:</p>
		<div id="code">
		<code>
		 {"Search":[{"Title":"Where the Wild Things Are","Year":"2000","imdbID":"tt0533524","Type":"episode"},{"Title":"Where the Wild Things Are","Year":"2008","imdbID":"tt1002871","Type":"episode"},
		 {"Title":"Where the Wild Things Are","Year":"2009","imdbID":"tt1383797","Type":"episode"},{"Title":"Where the Wild Things Are","Year":"2009","imdbID":"tt1524591","Type":"episode"},
		 {"Title":"The Mob Reviews: 'Where the Wild Things Are' and 'Law Abiding Citizen'","Year":"2009","imdbID":"tt1535247","Type":"episode"},
		 {"Title":"Where the Wild Things Are/Paranormal Activity/Law Abiding Citizen","Year":"2009","imdbID":"tt1539917","Type":"episode"},
		 {"Title":"Where the Wild Things Are","Year":"2009","imdbID":"tt1800443","Type":"episode"},
		 {"Title":"Couples Retreat/The Vampire's Assistant/Where the Wild Things Are","Year":"2009","imdbID":"tt2135150","Type":"episode"},
		 {"Title":"Where the Wild Things Are","Year":"2012","imdbID":"tt2209490","Type":"episode"},{"Title":"Where the Wild Things Are","Year":"2009","imdbID":"tt3013474","Type":"episode"}]}
		</code>
		</div>
		 <p>If we do the search <code>httpRequest.open("GET", "http://www.omdbapi.com/?s='where the wild things are'&type=episode", true);</code>we get......exactly the same thing. So we
		 don't have to worry about which way we submit the search with this method.</p>
				
		<a name="example">
		<h2>A Cool Example</h2>
		<h3>Open Movie Data Base Testing</h3>
		<form id="search">
		<br>
		We can do a broad search and then narrow it down.
		<br>
		<br>
		Title<input type="text" name="title"><br>
		<br>
		Year<input type="text" name="year"><br>
		<br>
		<button onclick="javascript:search();">Search</button>
		</form>
		
		<div id="searchResults">
		Search Results
		</div>
	</body>
</html>

