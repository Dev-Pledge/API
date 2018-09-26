<?php

namespace DevPledge\Application\Factory;


use DevPledge\Domain\Count;

/**
 * Class GitHubFactory
 * @package DevPledge\Application\Factory
 */
class GitHubUserFactory extends AbstractFactory {

	/**
	 *            'user_id'      => $this->getId(),
	 * 'id'           => $this->getGitHubId(),
	 * 'login'        => $this->getLogin(),
	 * 'node_id'      => $this->getNodeId(),
	 * 'avatar_url'   => $this->getAvatarUrl(),
	 * 'gravatar_id'  => $this->getGravatarId(),
	 * 'type'         => $this->getType(),
	 * 'site_admin'   => $this->getSiteAdmin(),
	 * 'name'         => $this->getName(),
	 * 'company'      => $this->getCompany(),
	 * 'blog'         => $this->getBlog(),
	 * 'bio'          => $this->getBio(),
	 * 'location'     => $this->getLocation(),
	 * 'email'        => $this->getEmail(),
	 * 'hireable'     => $this->getHireable(),
	 * 'public_repos' => $this->getPublicRepos()->getCount(),
	 * 'public_gists' => $this->getPublicGists()->getCount(),
	 * 'followers'    => $this->getFollowers()->getCount(),
	 * 'following'    => $this->getFollowing()->getCount(),
	 * 'created_at' => $this->getCreated()->format( 'Y-m-d H:i:s' ),
	 * 'updated_at' => $this->getModified()->format( 'Y-m-d H:i:s' )
	 * @return $this
	 */
	function setMethodsToProductObject() {
		return $this
			->setMethodToProductObject( 'id', 'setGitHubId' )
			->setMethodToProductObject( 'login', 'setLogin' )
			->setMethodToProductObject( 'node_id', 'setNodeId' )
			->setMethodToProductObject( 'avatar_url', 'setAvatarUrl' )
			->setMethodToProductObject( 'gravatar_id', 'setGravatarId' )
			->setMethodToProductObject( 'type', 'setType' )
			->setMethodToProductObject( 'site_admin', 'setSiteAdmin' )
			->setMethodToProductObject( 'name', 'setName' )
			->setMethodToProductObject( 'company', 'setCompany' )
			->setMethodToProductObject( 'blog', 'setBlog' )
			->setMethodToProductObject( 'bio', 'setBio' )
			->setMethodToProductObject( 'location', 'setLocation' )
			->setMethodToProductObject( 'email', 'setEmail' )
			->setMethodToProductObject( 'hireable', 'setHireable' )
			->setMethodToProductObject( 'public_repos', 'setPublicRepos', Count::class )
			->setMethodToProductObject( 'public_gists', 'setPublicGists', Count::class )
			->setMethodToProductObject( 'followers', 'setFollowers', Count::class )
			->setMethodToProductObject( 'following', 'setFollowing', Count::class );

	}

	protected function setCreatedModified() {

		return $this
			->setMethodToProductObject(
				'created_at',
				'setCreated',
				\DateTime::class
			)
			->setMethodToProductObject(
				'updated_at',
				'setModified',
				\DateTime::class
			);
	}
}