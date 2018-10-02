<?php

namespace DevPledge\Domain;
/**
 * "login": "JRSaunders",
 * "id": 6054445,
 * "node_id": "MDQ6VXNlcjYwNTQ0NDU=",
 * "avatar_url": "https://avatars0.githubusercontent.com/u/6054445?v=4",
 * "gravatar_id": "",
 * "url": "https://api.github.com/users/JRSaunders",
 * "html_url": "https://github.com/JRSaunders",
 * "followers_url": "https://api.github.com/users/JRSaunders/followers",
 * "following_url": "https://api.github.com/users/JRSaunders/following{/other_user}",
 * "gists_url": "https://api.github.com/users/JRSaunders/gists{/gist_id}",
 * "starred_url": "https://api.github.com/users/JRSaunders/starred{/owner}{/repo}",
 * "subscriptions_url": "https://api.github.com/users/JRSaunders/subscriptions",
 * "organizations_url": "https://api.github.com/users/JRSaunders/orgs",
 * "repos_url": "https://api.github.com/users/JRSaunders/repos",
 * "events_url": "https://api.github.com/users/JRSaunders/events{/privacy}",
 * "received_events_url": "https://api.github.com/users/JRSaunders/received_events",
 * "type": "User",
 * "site_admin": false,
 * "name": "John Saunders",
 * "company": "@Sub-Tech @Dev-Pledge ",
 * "blog": "",
 * "location": "Kent",
 * "email": "john@yettimedia.co.uk",
 * "hireable": null,
 * "bio": "20 Years Experience Developing Software, Websites & Apps. ",
 * "public_repos": 10,
 * "public_gists": 0,
 * "followers": 5,
 * "following": 4,
 * "created_at": "2013-11-28T00:10:29Z",
 * "updated_at": "2018-08-28T10:18:57Z"
 */


/**
 * Class GitHubUser
 * @package DevPledge\Domain
 */
class GitHubUser extends AbstractDomain {
	/**
	 * @var string
	 */
	protected $login;
	/**
	 * @var int
	 */
	protected $gitHubId;
	/**
	 * @var string
	 */
	protected $nodeId;
	/**
	 * @var string
	 */
	protected $avatarUrl;
	/**
	 * @var string
	 */
	protected $gravatarId;
	/**
	 * @var string
	 */
	protected $type;
	/**
	 * @var string
	 */
	protected $siteAdmin;
	/**
	 * @var string
	 */
	protected $name;
	/**
	 * @var string
	 */
	protected $company;
	/**
	 * @var string
	 */
	protected $blog;
	/**
	 * @var string
	 */
	protected $location;
	/**
	 * @var Count
	 */
	protected $publicRepos;
	/**
	 * @var string
	 */
	protected $email;
	/**
	 * @var string | null
	 */
	protected $hireable;
	/**
	 * @var string
	 */
	protected $bio;
	/**
	 * @var Count
	 */
	protected $publicGists;
	/**
	 * @var Count
	 */
	protected $followers;
	/**
	 * @var Count
	 */
	protected $following;

	/**
	 * @param int $gitHubId
	 *
	 * @return GitHubUser
	 */
	public function setGitHubId( int $gitHubId ): GitHubUser {
		$this->gitHubId = $gitHubId;

		return $this;
	}

	/**
	 * @return int
	 */
	public function getGitHubId(): int {
		return $this->gitHubId;
	}

	/**
	 *  * "login": "JRSaunders",
	 * "id": 6054445,
	 * "node_id": "MDQ6VXNlcjYwNTQ0NDU=",
	 * "avatar_url": "https://avatars0.githubusercontent.com/u/6054445?v=4",
	 * "gravatar_id": "",
	 * "type": "User",
	 * "site_admin": false,
	 * "name": "John Saunders",
	 * "company": "@Sub-Tech @Dev-Pledge ",
	 * "blog": "",
	 * "location": "Kent",
	 * "email": "john@yettimedia.co.uk",
	 * "hireable": null,
	 * "bio": "20 Years Experience Developing Software, Websites & Apps. ",
	 * "public_repos": 10,
	 * "public_gists": 0,
	 * "followers": 5,
	 * "following": 4,
	 * "created_at": "2013-11-28T00:10:29Z",
	 * "updated_at": "2018-08-28T10:18:57Z"
	 * @return \stdClass
	 */
	function toPersistMap(): \stdClass {
		return (object) [
			'user_id'      => $this->getId(),
			'id'           => $this->getGitHubId(),
			'login'        => $this->getLogin(),
			'node_id'      => $this->getNodeId(),
			'avatar_url'   => $this->getAvatarUrl(),
			'gravatar_id'  => $this->getGravatarId(),
			'type'         => $this->getType(),
			'site_admin'   => $this->getSiteAdmin(),
			'name'         => $this->getName(),
			'company'      => $this->getCompany(),
			'blog'         => $this->getBlog(),
			'bio'          => $this->getBio(),
			'location'     => $this->getLocation(),
			'email'        => $this->getEmail(),
			'hireable'     => $this->getHireable(),
			'public_repos' => $this->getPublicRepos()->getCount(),
			'public_gists' => $this->getPublicGists()->getCount(),
			'followers'    => $this->getFollowers()->getCount(),
			'following'    => $this->getFollowing()->getCount(),
			'created_at'   => $this->getCreated()->format( 'Y-m-d H:i:s' ),
			'updated_at'   => $this->getModified()->format( 'Y-m-d H:i:s' )
		];
	}

	/**
	 * @param string $login
	 *
	 * @return GitHubUser
	 */
	public function setLogin( string $login ): GitHubUser {
		$this->login = $login;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getLogin(): string {
		return $this->login;
	}

	/**
	 * @return string
	 */
	public function getGitHubUsername(): string {
		return $this->getLogin();
	}

	/**
	 * @param string $nodeId
	 *
	 * @return GitHubUser
	 */
	public function setNodeId( string $nodeId ): GitHubUser {
		$this->nodeId = $nodeId;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getNodeId(): string {
		return $this->nodeId;
	}

	/**
	 * @param mixed $avatarUrl
	 *
	 * @return GitHubUser
	 */
	public function setAvatarUrl( $avatarUrl ) {
		$this->avatarUrl = $avatarUrl;

		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getAvatarUrl() {
		return $this->avatarUrl;
	}

	/**
	 * @param string|null $gravatarId
	 *
	 * @return GitHubUser
	 */
	public function setGravatarId( ?string $gravatarId ): GitHubUser {
		$this->gravatarId = $gravatarId;

		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getGravatarId(): ?string {
		return $this->gravatarId;
	}

	/**
	 * @param string $type
	 *
	 * @return GitHubUser
	 */
	public function setType( string $type ): GitHubUser {
		$this->type = $type;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getType(): string {
		return $this->type;
	}

	/**
	 * @param string|null $siteAdmin
	 *
	 * @return GitHubUser
	 */
	public function setSiteAdmin( ?bool $siteAdmin ): GitHubUser {
		$this->siteAdmin = $siteAdmin;

		return $this;
	}

	/**
	 * @return bool|null
	 */
	public function getSiteAdmin(): ?bool {
		return isset( $this->siteAdmin ) ? $this->siteAdmin : false;
	}

	/**
	 * @param string|null $name
	 *
	 * @return GitHubUser
	 */
	public function setName( ?string $name ): GitHubUser {
		$this->name = $name;

		return $this;
	}

	/**
	 * @return string | null
	 */
	public function getName(): ?string {
		return $this->name;
	}

	/**
	 * @param string|null $company
	 *
	 * @return GitHubUser
	 */
	public function setCompany( ?string $company ): GitHubUser {
		$this->company = $company;

		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getCompany(): ?string {
		return $this->company;
	}

	/**
	 * @param string|null $blog
	 *
	 * @return GitHubUser
	 */
	public function setBlog( ?string $blog ): GitHubUser {
		$this->blog = $blog;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getBlog(): ?string {
		return $this->blog;
	}

	/**
	 * @param string|null $location
	 *
	 * @return GitHubUser
	 */
	public function setLocation( ?string $location ): GitHubUser {
		$this->location = $location;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getLocation(): ?string {
		return $this->location;
	}

	/**
	 * @param string|null $email
	 *
	 * @return GitHubUser
	 */
	public function setEmail( ?string $email ): GitHubUser {
		$this->email = $email;

		return $this;
	}

	/**
	 * @return string | null
	 */
	public function getEmail(): ?string {
		return $this->email;
	}

	/**
	 * @param null|string $hireable
	 *
	 * @return GitHubUser
	 */
	public function setHireable( ?string $hireable ): GitHubUser {
		$this->hireable = $hireable;

		return $this;
	}

	/**
	 * @return null|string
	 */
	public function getHireable(): ?string {
		return $this->hireable;
	}

	/**
	 * @param string| null $bio
	 *
	 * @return GitHubUser
	 */
	public function setBio( ?string $bio ): GitHubUser {
		$this->bio = $bio;

		return $this;
	}

	/**
	 * @return string | null
	 */
	public function getBio(): ?string {
		return $this->bio;
	}

	/**
	 * @param Count $publicRepos
	 *
	 * @return GitHubUser
	 */
	public function setPublicRepos( Count $publicRepos ): GitHubUser {
		$this->publicRepos = $publicRepos;

		return $this;
	}

	/**
	 * @return Count
	 */
	public function getPublicRepos(): Count {
		return $this->publicRepos ?? new Count( 0 );
	}

	/**
	 * @param Count $publicGists
	 *
	 * @return GitHubUser
	 */
	public function setPublicGists( Count $publicGists ): GitHubUser {
		$this->publicGists = $publicGists;

		return $this;
	}

	/**
	 * @return Count
	 */
	public function getPublicGists(): Count {
		return $this->publicGists ?? new Count( 0 );
	}

	/**
	 * @param Count $followers
	 *
	 * @return GitHubUser
	 */
	public function setFollowers( Count $followers ): GitHubUser {
		$this->followers = $followers;

		return $this;
	}

	/**
	 * @return Count
	 */
	public function getFollowers(): Count {
		return $this->followers ?? new Count( 0 );
	}

	/**
	 * @param Count $following
	 *
	 * @return GitHubUser
	 */
	public function setFollowing( Count $following ): GitHubUser {
		$this->following = $following;

		return $this;
	}

	/**
	 * @return Count
	 */
	public function getFollowing(): Count {
		return $this->following ?? new Count( 0 );
	}


}