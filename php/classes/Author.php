<?php
// temp fix
require_once ("ValidateUuid.php");
use Ramsey\Uuid\Uuid;


/**
 * This is the primary profile type for authors
 *
 * This profile is a small example of the type of profile that may br created for Authors of articles on Wired.com
 * Not all parts of the profile exist here but it can be easily extended to emulate the format of Wired.com
 * or other article based publications.
 *
 * @author Erik Clevenger erik@modwrk.com
 * @version 1.0.0
 *
 **/

class author implements \JsonSerializable {
	use \ValidateUuid;

	/**
	 * id for this Author; this is the primary key
	 *
	 * @var Uuid $authorId
	 *
	 **/
	protected $authorId;

	/**
	 * a brief section of information about the author of an article
	 *
	 * @var string $authorBio
	 **/
	protected $authorBio;

	/**
	 * the author's email address used for authentication NOT to be confused with a public facing email for contact.
	 * This must be unique
	 * @var string $authorEmail
	 **/
	protected $authorEmail;

	/**
	 * The hash used for password encryption; user authentication
	 * @var string $authorHash
	 **/
	protected $authorHash;

	/**
	 * A profile image of the author to be displayed with the author's bio
	 * @var longblob $authorImage
	 **/
	protected $authorImage;

	/**
	 * The author's name as opposed to a user handle
	 * @var varchar(32) $authorName
	 **/
	protected $authorName;

	/**
	 *
	 * Constructor for this author
	 *
	 * Takes an argument of an array. Within the array arguments can
	 *
	 * @param string|Uuid $newAuthorId of author
	 * @param string|null $newAuthorBio A string containing the author's bio
	 * @param string $newAuthorEmail providing the author's email
	 * @param int $newAuthorHash containing the authentication hash
	 * @param string|null $newAuthorImage an image of the author
	 * @param string $newAuthorName a string containg the author's name
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers)
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 **/

	public function __construct(string $newAuthorId, string $newAuthorBio, string $newAuthorEmail, string $newAuthorHash,
										 string $newAuthorImage, string $newAuthorName) {
		try {
			$this->setAuthorId($newAuthorId);
			$this->setAuthorBio($newAuthorBio);
			$this->setAuthorEmail($newAuthorEmail);
			$this->setAuthorHash($newAuthorHash);
			$this->setAuthorImage($newAuthorImage);
			$this->setAuthorName($newAuthorName);
		} //identify thrown exceptions
	catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
		$exceptionType = get_class($exception);
		throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}


	/**
	 * Fetches the author's ID from mySQL,
	 *
	 * @return Uuid
	 */
	public function getAuthorId(): Uuid {
		return ($this->authorId);
	}

	/**
	 * Sets the author's primary key/ Id number
	 *
	 * @param Uuid $authorId
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers)
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 */
	public function setAuthorId($authorId): void {
		try {
			$uuid = self::validateUuid($authorId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw new $exceptionType($exception->getMessage(), 0, $exception);
		}

		$this->authorId = $uuid;
	}

	/**
	 * accessor method for the author bio
	 *
	 * @return string
	 */
	public function getAuthorBio(): string {
		return ($this->authorBio);
	}

	/**
	 *Sets the sanitized author bio.
	 *
	 * @param string $newAuthorBio
	 */
	public function setAuthorBio(string $newAuthorBio): void {
		$newAuthorBio = trim($newAuthorBio);
		$newAuthorBio = filter_var($newAuthorBio, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if (empty($newAuthorBio) === true) {
			echo "No Bio";
		}
		if (strlen($newAuthorBio > 140) === true) {
			echo "The bio is too long, try to keep is short and sweet (as in 140 characters).";
		}
		$this->authorBio = $newAuthorBio;
	}

	/**
	 * accessor method for author email
	 *
	 * @return string
	 */
	public function getAuthorEmail(): string {
		return ($this->authorEmail);
	}


	/**
	 * inserts the author's email in mySQL
	 *
	 * @param string $newAuthorEmail
	 * @throws \InvalidArgumentException if $newFanEmail is not a valid email or insecure
	 * @throws \RangeException if $newEmail is > 128 characters
	 * @throws \TypeError if $newEmail is not a string
	 */
	public function setAuthorEmail(string $newAuthorEmail): void {
		$authorEmail = (trim($newAuthorEmail));
		$authorEmail = filter_var($authorEmail, FILTER_VALIDATE_EMAIL);
		//validate email
		if(empty($authorEmail) === true) {
			throw (new \InvalidArgumentException("Sorry,'$authorEmail' doesn't seem to work."));
		}
		//check string length
		if(strlen($authorEmail) > 128) {
			throw (new \RangeException("Sorry, '$authorEmail' contains too many characters"));
		}
		//store email string
		$this->authorEmail = $newAuthorEmail;
	}



	/**
	 *
	 * Returns the author's profile password hash
	 *
	 * @return string
	 */
	public function getAuthorHash(): string {
		return ($this->authorHash);
	}

	/**
	 *
	 * Mutator method for the author's profile password hash.
	 *
	 * @param string $newAuthorHash
	 * @throws \InvalidArgumentException if the hash is not secure
	 * @throws \RangeException if the hash is not 87 characters
	 * @throws \TypeError if profile hash is not a string
	 */

	//Fully Bamboozled from @brentTheDev Brent Kai

	public function setAuthorHash(string $newAuthorHash): void {
		//enforce that the hash is properly formatted
		$newAuthorHash = trim($newAuthorHash);
		$newAuthorHash = strtolower($newAuthorHash);
		if(empty($newAuthorHash) === true) {
			throw(new \InvalidArgumentException("profile password hash empty or insecure"));
		}
		//enforce that the hash is a string representation of a hexadecimal
		if(!ctype_xdigit($newAuthorHash)) {
			throw(new \InvalidArgumentException("profile password hash is empty or insecure"));
		}
		//enforce that the hash is exactly 97 characters.
		if(strlen($newAuthorHash) !== 97) {
			throw(new \RangeException("profile hash must be 128 characters"));
		}
		//store the hash
		$this->AuthorHash = $newAuthorHash;
	}

	/**
	 *
	 * Return a processed image
	 *
	 * @return string
	 */
	public function getAuthorImage(): string {
		return ($this->authorImage);
	}

	/**
	 * Validates and sanitizes image image data
	 *
	 * @param string $authorImage
	 */
	public function setAuthorImage(string $authorImage): void {
		$this->authorImage = $authorImage;
	}

	/**
	 * Accessor for the author's name.
	 *
	 * @return string
	 */
	public function getAuthorName(): string {
		return ($this->authorName);
	}

	/**
	 * Sanitizes, Validates author's name string
	 *
	 * @param string $newAuthorName
	 * @throw \InvalidArgumentException if $newAuthorName is not a valid object or string
	 * @throw \RangeException if $newAuthorName is > 32 characters
	 */
	public function setAuthorName(string $newAuthorName): void {
		$newAuthorName = trim($newAuthorName);
		$newAuthorName = filter_var($newAuthorName, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

		if(empty($newAuthorName) === true) {
			throw (new \InvalidArgumentException("Sorry,'$newAuthorName' doesn't seem to work."));
		}
		//check string length
		if(strlen($newAuthorName) > 32) {
			throw (new \RangeException("Sorry, '$newAuthorName' contains too many characters."));
		}

		$this->authorEmail = $newAuthorName;
	}


	/**
	 * Inserts this Author into mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related error occurs
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/


		public function insert(\PDO $pdo) : void {
			//query template
			$query = "INSERT INTO author(authorId, authorBio, authorEmail, authorHash, authorImage, authorName) VALUES (:authorId, :authorBio, :authorEmail, :authorHash, :authorImage, :authorName)";
			$statement = $pdo->prepare($query);

			// bind the member variables to the place holder template
			$parameters = ["authorId" => $this->authorId->getBytes(), "authorBio" => $this->authorBio, "authorEmail" =>
				$this->authorEmail, "authorImage" => $this->authorImage, "authorName" => $this->authorName];
			$statement->execute($parameters);
		}


	/**
	 *
	 * Delete this Author from mySQL
	 *
	 * @param PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 */
	public function delete(\PDO $pdo) : void {

		// create query template
		$query = "DELETE FROM author WHERE authorId = :authorId";
		$statement = $pdo->prepare($query);

		// bind the member variables to the place holder in the template
		$parameters = ["authorId" => $this->authorId->getBytes()];
		$statement->execute($parameters);
	}

	/**
	 * updates this Author in mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function update(\PDO $pdo) : void {

		// create query template
		$query = "UPDATE author SET authorId = :authorId, authorBio = :authorBio, authorEmail = :authorEmail, authorHash = :authorHash, authorImage = :authorImage, authorName = :authorName WHERE authorId = :authorId";
		$statement = $pdo->prepare($query);



		$parameters = ["authorId" => $this->authorId->getBytes(),"authorBio" => $this->authorBio, "authorEmail" =>
			$this->authorEmail, "authorHash" => $this->authorHash->getBytes(), "authorImage" => $this->authorImage, "authorName" => $this->authorName ];
		$statement->execute($parameters);
	}

	public function jsonSerialize() :array {
		$fields = get_object_vars($this);
		unset($fields["authorId"]);
		unset($fields["authorHash"]);

		$fields["authorId"] = $this->authorId->toString();
		return ($fields);
	}

}






