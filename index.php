<!DOCTYPE html PUBLIC>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Deep Dive Data Design</title>
	</head>
	<body>
		<div class="section persona"></div>
			<h2>User Details</h2>
			<img src="" alt="">
			<table>
				<tr>
					<th>Name</th>
					<th>Gender</th>
					<th>Age</th>
					<th>Device(s)</th>
					<th>Confidence</th>
				</tr>
				<tr>
					<td>Aaron Daniel</td>
					<td>Male</td>
					<td>29</td>
					<td>iPhone 8s iOS 11.2.6 <br>
					MacBook Pro OSX 10.13.3
					</td>
					<td>Very Confident</td>
				</tr>
			</table>
			<h3>Attitudes</h3>
			<p>Aaron is choosy about his news resources and is often skeptical about the validity of articles posted by large media companies.</p>
			<h3>Goals</h3>
			<p>To quickly find more articles written by a specific author.</p>
			<h3>Frustrations</h3>
			<p>News sites that make author information difficult to read or find.</p>
		</div>
		<div class="section userStory">
			<h2>User Story</h2>
			<p><q>As a consistent but unregistered user I want to determine who wrote a specific article quickly and easily.</q></p>
		</div>
		<div class="section useCaseInteraction">
			<h2>Scenario</h2>
			<p>While reading his usual sources for tech news Aaron reads through an article conveying opinions he tends to agree with.<br>
			Recognizing the writing style he wants to find other articles by the same author.</p>
			<h4>Preconditions</h4>
			<p>Aaron is familiar with Wired.com</p>
			<h4>Postconditions</h4>
			<p>The site displays a list of articles by a specific author.</p>
			<h3>Interaction Flow</h3>
			<ul>
				<li>Aaron navigates to Wired.com/threatlevel</li>
				<li>Site displays several articles tagged under threat level. </li>
				<li>Aaron clicks a story.</li>
				<li>Site displays a banner image and information about the story including the article's publish date and author name.</li>
				<li>After reading the story Aaron scrolls back to the tops of the page and clicks the Author's name.</li>
				<li>The site displays a photo of the author, a short bio, and several more articles they've written.</li>
			</ul>
		</div>
		<div class="section conceptualModel">
			<h2>Entities &amp; Attributes</h2>
			<ul>
				<li class="modelSection">Author Profile</li>
				<ul>
					<li>authorId(primary key)</li>
					<li>authorName</li>
					<li>authorBio</li>
					<li>authorEmail</li>
					<li>authorHash</li>
					<li>authorImage</li>
				</ul>
				<li class="modelSection">Article</li>
				<ul>
					<li>articleID (primary key)</li>
					<li>articleAuthorId (foreign key)</li>
					<li>articleTitle</li>
					<li>articleDate</li>
					<li>articleTags</li>
					<li>articleBannerImg</li>
					<li>articleContent</li>
				</ul>
			</ul>
			<h2>Relations</h2>
			<p>One author can write many articles. (<em>1</em>&nbsp;to&nbsp;<em>n</em>)</p>
		</div>
	</body>
</html>