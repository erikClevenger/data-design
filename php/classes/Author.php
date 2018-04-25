<?php
// temp fix
require_once ("ValidateUuid.php");

//TODO add FILTER_SANITIZE to setters

//TODO finish doc blocks
//TODO lookup GD php library




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
class author{
	use \Edu\Cnm\DataDesign\ValidateUuid;

	/**
	 * id for this Author; this is the primary key
	 * @var Uuid $authorId
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

	public function __construct(Uuid $newAuthorId, string $newAuthorBio, string $newAuthorEmail, int $newAuthorHash,
										 string $newAuthorImage, string $newAuthorName) {
		try {
			$this->authorId($newAuthorId);
			$this->authorBio($newAuthorBio);
			$this->authorEmail($newAuthorEmail);
			$this->authorHash($newAuthorHash);
			$this->authorImage($newAuthorImage);
			$this->authorName($newAuthorName);
		} //determine what exception type was thrown
		catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}


	/**
	 * @return uuid
	 */
	public function getAuthorId(): Uuid {
		return ($this->authorId);
	}

	/**
	 * @param uuid $authorId
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
		return ($this->authorEmail);
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
		return ($this->authorHash);
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

}






