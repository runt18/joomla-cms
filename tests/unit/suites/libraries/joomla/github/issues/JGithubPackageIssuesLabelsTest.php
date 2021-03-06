<?php

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.0 on 2013-01-29 at 08:34:13.
 */
class JGithubPackageIssuesLabelsTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @var    JRegistry  Options for the GitHub object.
	 * @since  11.4
	 */
	protected $options;

	/**
	 * @var    JGithubHttp  Mock client object.
	 * @since  11.4
	 */
	protected $client;

	/**
	 * @var    JHttpResponse  Mock response object.
	 * @since  12.3
	 */
	protected $response;

	/**
	 * @var JGithubPackageIssuesLabels
	 */
	protected $object;

	/**
	 * @var    string  Sample JSON string.
	 * @since  12.3
	 */
	protected $sampleString = '{"a":1,"b":2,"c":3,"d":4,"e":5}';

	/**
	 * @var    string  Sample JSON error message.
	 * @since  12.3
	 */
	protected $errorString = '{"message": "Generic Error"}';

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 */
	protected function setUp()
	{
		parent::setUp();

		$this->options = new JRegistry;
		$this->client = $this->getMock('JGithubHttp', array('get', 'post', 'delete', 'patch', 'put'));
		$this->response = $this->getMock('JHttpResponse');

		$this->object = new JGithubPackageIssuesLabels($this->options, $this->client);
	}

	/**
	 * @covers JGithubPackageIssuesLabels::getList
	 *         GET /repos/:owner/:repo/labels
	 *
	 * Response
	 *
	 * Status: 200 OK
	 * X-RateLimit-Limit: 5000
	 * X-RateLimit-Remaining: 4999
	 */
	public function testGetList()
	{
		$this->response->code = 200;
		$this->response->body = $this->sampleString;

		$this->client->expects($this->once())
		             ->method('get')
		             ->with('/repos/joomla/joomla-platform/labels', 0, 0)
		             ->will($this->returnValue($this->response))
		;

		$this->assertThat(
			$this->object->getList('joomla', 'joomla-platform', '1'),
			$this->equalTo(json_decode($this->response->body))
		)
		;
	}

	/**
	 * @covers JGithubPackageIssuesLabels::get
	 *
	 * GET /repos/:owner/:repo/labels/:name
	 *
	 * Response
	 *
	 * Status: 200 OK
	 * X-RateLimit-Limit: 5000
	 * X-RateLimit-Remaining: 4999
	 */
	public function testGet()
	{
		$this->response->code = 200;
		$this->response->body = $this->sampleString;

		$this->client->expects($this->once())
		             ->method('get')
		             ->with('/repos/joomla/joomla-platform/labels/1', 0, 0)
		             ->will($this->returnValue($this->response))
		;

		$this->assertThat(
			$this->object->get('joomla', 'joomla-platform', '1'),
			$this->equalTo(json_decode($this->response->body))
		)
		;
	}

	/**
	 * @covers JGithubPackageIssuesLabels::create
	 *
	 * POST /repos/:owner/:repo/labels
	 *
	 * Input
	 *
	 * name
	 * Required string
	 * color
	 * Required string - 6 character hex code, without a leading #.
	 *
	 * {
	 * "name": "API",
	 * "color": "FFFFFF"
	 * }
	 *
	 * Response
	 *
	 * Status: 201 Created
	 * Location: https://api.github.com/repos/user/repo/labels/foo
	 * X-RateLimit-Limit: 5000
	 * X-RateLimit-Remaining: 4999
	 *
	 * {
	 * "url": "https://api.github.com/repos/octocat/Hello-World/labels/bug",
	 * "name": "bug",
	 * "color": "f29513"
	 * }
	 */
	public function testCreate()
	{
		$this->response->code = 201;
		$this->response->body = $this->sampleString;

		$this->client->expects($this->once())
		             ->method('post')
		             ->with('/repos/joomla/joomla-platform/labels', '{"name":"foobar","color":"red"}', 0, 0)
		             ->will($this->returnValue($this->response))
		;

		$this->assertThat(
			$this->object->create('joomla', 'joomla-platform', 'foobar', 'red'),
			$this->equalTo(json_decode($this->response->body))
		)
		;
	}

	/**
	 * @expectedException DomainException
	 */
	public function testCreateFailure()
	{
		$this->response->code = 404;
		$this->response->body = $this->errorString;

		$this->client->expects($this->once())
		             ->method('post')
		             ->with('/repos/joomla/joomla-platform/labels', '{"name":"foobar","color":"red"}', 0, 0)
		             ->will($this->returnValue($this->response))
		;

		$this->assertThat(
			$this->object->create('joomla', 'joomla-platform', 'foobar', 'red'),
			$this->equalTo(json_decode($this->response->body))
		)
		;
	}

	/**
	 * @covers JGithubPackageIssuesLabels::update
	 *
	 * PATCH /repos/:owner/:repo/labels/:name
	 *
	 * Input
	 *
	 * name
	 * Required string
	 * color
	 * Required string - 6 character hex code, without a leading #.
	 *
	 * {
	 * "name": "API",
	 * "color": "FFFFFF"
	 * }
	 *
	 * Response
	 *
	 * Status: 200 OK
	 * X-RateLimit-Limit: 5000
	 * X-RateLimit-Remaining: 4999
	 *
	 * {
	 * "url": "https://api.github.com/repos/octocat/Hello-World/labels/bug",
	 * "name": "bug",
	 * "color": "f29513"
	 * }
	 */
	public function testUpdate()
	{
		$this->response->code = 200;
		$this->response->body = $this->sampleString;

		$this->client->expects($this->once())
		             ->method('patch')
		             ->with('/repos/joomla/joomla-platform/labels/foobar', '{"name":"boofaz","color":"red"}', 0, 0)
		             ->will($this->returnValue($this->response))
		;

		$this->assertThat(
			$this->object->update('joomla', 'joomla-platform', 'foobar', 'boofaz', 'red'),
			$this->equalTo(json_decode($this->response->body))
		)
		;
	}

	/**
	 * @covers JGithubPackageIssuesLabels::delete
	 *
	 * DELETE /repos/:owner/:repo/labels/:name
	 *
	 * Response
	 *
	 * Status: 204 No Content
	 * X-RateLimit-Limit: 5000
	 * X-RateLimit-Remaining: 4999
	 */
	public function testDelete()
	{
		$this->response->code = 204;
		$this->response->body = $this->sampleString;

		$this->client->expects($this->once())
		             ->method('delete')
		             ->with('/repos/joomla/joomla-platform/labels/foobar', 0, 0)
		             ->will($this->returnValue($this->response))
		;

		$this->assertThat(
			$this->object->delete('joomla', 'joomla-platform', 'foobar'),
			$this->equalTo(json_decode($this->response->body))
		)
		;
	}

	/**
	 * @covers JGithubPackageIssuesLabels::getListByIssue
	 *
	 * GET /repos/:owner/:repo/issues/:number/labels
	 *
	 * Response
	 *
	 * Status: 200 OK
	 * X-RateLimit-Limit: 5000
	 * X-RateLimit-Remaining: 4999
	 */
	public function testGetListByIssue()
	{
		$this->response->code = 200;
		$this->response->body = $this->sampleString;

		$this->client->expects($this->once())
		             ->method('get')
		             ->with('/repos/joomla/joomla-platform/issues/1/labels', 0, 0)
		             ->will($this->returnValue($this->response))
		;

		$this->assertThat(
			$this->object->getListByIssue('joomla', 'joomla-platform', 1),
			$this->equalTo(json_decode($this->response->body))
		)
		;
	}

	/**
	 * @covers JGithubPackageIssuesLabels::add
	 *
	 * POST /repos/:owner/:repo/issues/:number/labels
	 *
	 * Input
	 *
	 * [
	 * "Label1",
	 * "Label2"
	 * ]
	 *
	 * Response
	 *
	 * Status: 200 OK
	 * X-RateLimit-Limit: 5000
	 * X-RateLimit-Remaining: 4999
	 *
	 * [
	 * {
	 * "url": "https://api.github.com/repos/octocat/Hello-World/labels/bug",
	 * "name": "bug",
	 * "color": "f29513"
	 * }
	 * ]
	 */
	public function testAdd()
	{
		$this->response->code = 200;
		$this->response->body = $this->sampleString;

		$this->client->expects($this->once())
		             ->method('post')
		             ->with('/repos/joomla/joomla-platform/issues/1/labels', '["A","B"]', 0, 0)
		             ->will($this->returnValue($this->response))
		;

		$this->assertThat(
			$this->object->add('joomla', 'joomla-platform', 1, array('A', 'B')),
			$this->equalTo(json_decode($this->response->body))
		)
		;
	}

	/**
	 * @covers JGithubPackageIssuesLabels::removeFromIssue
	 *
	 * DELETE /repos/:owner/:repo/issues/:number/labels/:name
	 *
	 * Response
	 *
	 * Status: 200 OK
	 * X-RateLimit-Limit: 5000
	 * X-RateLimit-Remaining: 4999
	 *
	 * [
	 * {
	 * "url": "https://api.github.com/repos/octocat/Hello-World/labels/bug",
	 * "name": "bug",
	 * "color": "f29513"
	 * }
	 * ]
	 */
	public function testRemoveFromIssue()
	{
		$this->response->code = 200;
		$this->response->body = $this->sampleString;

		$this->client->expects($this->once())
		             ->method('delete')
		             ->with('/repos/joomla/joomla-platform/issues/1/labels/foobar', 0, 0)
		             ->will($this->returnValue($this->response))
		;

		$this->assertThat(
			$this->object->removeFromIssue('joomla', 'joomla-platform', 1, 'foobar'),
			$this->equalTo(json_decode($this->response->body))
		)
		;
	}

	/**
	 * @covers JGithubPackageIssuesLabels::replace
	 *
	 * PUT /repos/:owner/:repo/issues/:number/labels
	 *
	 * Input
	 *
	 * [
	 * "Label1",
	 * "Label2"
	 * ]
	 *
	 * Sending an empty array ([]) will remove all Labels from the Issue.
	 * Response
	 *
	 * Status: 200 OK
	 * X-RateLimit-Limit: 5000
	 * X-RateLimit-Remaining: 4999
	 *
	 * [
	 * {
	 * "url": "https://api.github.com/repos/octocat/Hello-World/labels/bug",
	 * "name": "bug",
	 * "color": "f29513"
	 * }
	 * ]
	 */
	public function testReplace()
	{
		$this->response->code = 200;
		$this->response->body = $this->sampleString;

		$this->client->expects($this->once())
		             ->method('put')
		             ->with('/repos/joomla/joomla-platform/issues/1/labels', '["A","B"]', 0, 0)
		             ->will($this->returnValue($this->response))
		;

		$this->assertThat(
			$this->object->replace('joomla', 'joomla-platform', 1, array('A', 'B')),
			$this->equalTo(json_decode($this->response->body))
		)
		;
	}

	/**
	 * @covers JGithubPackageIssuesLabels::removeAllFromIssue
	 *
	 * DELETE /repos/:owner/:repo/issues/:number/labels
	 *
	 * Response
	 *
	 * Status: 204 No Content
	 * X-RateLimit-Limit: 5000
	 * X-RateLimit-Remaining: 4999
	 */
	public function testRemoveAllFromIssue()
	{
		$this->response->code = 204;
		$this->response->body = $this->sampleString;

		$this->client->expects($this->once())
		             ->method('delete')
		             ->with('/repos/joomla/joomla-platform/issues/1/labels', 0, 0)
		             ->will($this->returnValue($this->response))
		;

		$this->assertThat(
			$this->object->removeAllFromIssue('joomla', 'joomla-platform', 1),
			$this->equalTo(json_decode($this->response->body))
		)
		;
	}

	/**
	 * @covers JGithubPackageIssuesLabels::getListByMilestone
	 *
	 * GET /repos/:owner/:repo/milestones/:number/labels
	 *
	 * Response
	 *
	 * Status: 200 OK
	 * X-RateLimit-Limit: 5000
	 * X-RateLimit-Remaining: 4999
	 *
	 * [
	 * {
	 * "url": "https://api.github.com/repos/octocat/Hello-World/labels/bug",
	 * "name": "bug",
	 * "color": "f29513"
	 * }
	 * ]
	 */
	public function testGetListByMilestone()
	{
		$this->response->code = 200;
		$this->response->body = $this->sampleString;

		$this->client->expects($this->once())
		             ->method('get')
		             ->with('/repos/joomla/joomla-platform/milestones/1/labels', 0, 0)
		             ->will($this->returnValue($this->response))
		;

		$this->assertThat(
			$this->object->getListByMilestone('joomla', 'joomla-platform', 1),
			$this->equalTo(json_decode($this->response->body))
		)
		;
	}
}
