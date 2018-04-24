<?php
// temp fix
require_once ("ValidateUuid.php");

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

class Author implements \JsonSerializable {
	use \Edu\Cnm\DataDesign\ValidateUuid;

	/**
	 * id for this Author; this is the primary key
	 * @var uuid $authorId
	 *
	 **/
	protected $authorId;

	/**
	 * a brief section of information about the author of an article
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
	 * @var char(97) $authorHash
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
	 * Constructor for this Tweet
	 *
	 * Takes an argument of an array. Within the array arguments can
	 *
	 * @param string|Uuid $authorId of author
	 * @param string|null $uthorBio A string containing the author's bio
	 * @param string $authorEmail providing the author's email
	 * @param string $authorHash containing the authentication hash
	 * @param string|null $authorImage an image of the author
	 * @param string $authorName a string containg the author's name
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers)
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 **/

	public function __construct($args = []) {
		try {
			$this->authorId = ['uuid'];
			$this->authorBio = ['bio'] ?? NULL;
			$this->authorEmail = ['email'];
			$this->authorHash = ['hash'];
			$this->authorImage = ['image'] ?? NULL;
			$this->authorName = ['name'];
			}
			//determine what exception type was thrown
		catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}



	/**
	 * @return uuid
	 */
	public function getauthorId(): Uuid {
		return ($this->authorId);
	}

	/**
	 * @param uuid $authorId
	 */
	public function setauthorId($authorId): void {
		try {
			$uuid = self::validateUuid($authorId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw new $exceptionType($exception->getMessage(), 0, $exception);
		}

		$this->authorId = $uuid;
	}

	/**
	 * @return string
	 */
	public function getAuthorBio(): string {
		return ($this->authorBio);
	}

	/**
	 * @param string $authorBio
	 */
	public function setAuthorBio(string $authorBio): void {
		$this->authorBio = $authorBio;
	}

	/**
	 * @return string
	 */
	public function getAuthorEmail(): string {
		return($this->authorEmail);
	}

	/**
	 * @param string $authorEmail
	 */
	public function setAuthorEmail(string $authorEmail): void {
		$this->authorEmail = $authorEmail;
	}

	/**
	 * @return string
	 */
	public function getAuthorHash(): string {
		return($this->authorHash);
	}

	/**
	 * @param string $authorHash
	 */
	public function setAuthorHash(string $authorHash): void {
		$this->authorHash = $authorHash;
	}

	/**
	 * @return string
	 */
	public function getAuthorImage(): string {
		return ($this->authorImage);
	}

	/**
	 * @param string $authorImage
	 */
	public function setAuthorImage(string $authorImage): void {
		$this->authorImage = $authorImage;
	}

	/**
	 * @return string
	 */
	public function getAuthorName(): string {
		return ($this->authorName);
	}

	/**
	 * @param string $authorName
	 */
	public function setAuthorName(string $authorName): void {
		$this->authorName = $authorName;
	}


	/**
	 * Specify data which should be serialized to JSON
	 * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
	 * @return mixed data which can be serialized by <b>json_encode</b>,
	 * which is a value of any type other than a resource.
	 * @since 5.4.0
	 */
	public function jsonSerialize() {
		// TODO: Implement jsonSerialize() method.
	}

	/**
	 * Inserts this Author into mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related error occurs
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/

	/*

	public function insert(\PDO $pdo) : void {
		//query template
		$query = "INSERT INTO author ()/ VALUES /* :value values for those arguments here ";
		$statement = $pdo->prepare($query);

		// bind the member variables to the place holder template
		$parameters = ["authorId" => $this->authorId->getBytes(), "authorBio" => $this->authorBio, "authorEmail" =>
			$this->authorEmail, "authorImage" => $this->authorImage, "authorName" => $this->authorName];
		$statement->execute($parameters);
	}

	*/

}



$testAuthor= new Author();

$testTest = $testAuthor->getauthorId();

$talkToMe = var_dump($testTest);

