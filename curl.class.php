<?php

class curl
{
	private $option = array();
	private $headers = array();
	private $curl;
	private $curlopt;

	public function __construct()
	{
		$this->curl = curl_init();
	}

	public function setUrl($url)
	{
		$this->setOpt(CURLOPT_URL, $url);
	}

	public function setRef($ref)
	{
		$this->setOpt(CURLOPT_REFERER, $ref);
	}

	public function setFollow($bool = true)
	{
		$this->setOpt(CURLOPT_FOLLOWLOCATION, $bool);
	}

	public function setHeader($bool = true)
	{
		$this->setOpt(CURLOPT_HEADER, $bool);
	}

	public function setTransfer($bool = true)
	{
		$this->setOpt(CURLOPT_RETURNTRANSFER, $bool);
	}

	public function setUserAgent($ua)
	{
		$this->setOpt(CURLOPT_USERAGENT, $ua);
	}

	public function setVerifyHost($options)
	{
		$this->setOpt(CURLOPT_SSL_VERIFYHOST, $options);
	}

	public function setVerifyPeer($bool = false)
	{
		$this->setOpt(CURLOPT_SSL_VERIFYPEER, $bool);
	}

	public function setNobody($bool = false)
	{
		$this->setOpt(CURLOPT_NOBODY, $bool);
	}

	public function setCookie($cookies)
	{
		$this->setOpt(CURLOPT_COOKIE, $cookies);
	}

	public function setCookieJar($cookies)
	{
		$this->setOpt(CURLOPT_COOKIEJAR, $cookies);
	}

	public function setCookieFile($cookies)
	{
		$this->setOpt(CURLOPT_COOKIEFILE, $cookies);
	}

	public function setCTO($time)
	{
		$this->setOpt(CURLOPT_CONNECTTIMEOUT, $time);
	}

	public function setEncoding($encode)
	{
		$this->setOpt(CURLOPT_ENCODING, $encode);
	}

	public function setSocks5($socks)
	{
		$this->setOpt(CURLOPT_HTTPPROXYTUNNEL, true); 
        $this->setOpt(CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5); 
        $this->setOpt(CURLOPT_PROXY, $socks);
	}

	public function setPost($data)
	{
		$this->setOpt(CURLOPT_POSTFIELDS, $data);
		$this->setOpt(CURLOPT_POST, true);
	}

	public function setHeaderOneHit($headers)
	{
		$this->setOpt(CURLOPT_HTTPHEADER, $headers);
	}

	public function setHeaderOrigin($origin)
	{
		$this->headers['origin'] = $origin;
	}

	public function setHeaderAccept($accept)
	{
		$this->headers['Accept'] = $accept;
	}

	public function setHeaderLang($lang)
	{
		$this->headers['Accept-Language'] = $lang;
	}

	public function setHeaderEncode($encode)
	{
		$this->headers['Accept-Encoding'] = $encode;
	}

	public function setHeaderHost($host)
	{
		$this->headers['Host'] = $host;
	}

	public function setHeaderContentType($content)
	{
		$this->headers['Content-Type'] = $content;
	}

	public function setHeaderCookie($cookie)
	{
		$this->headers['Cookie'] = $cookie;
	}

	public function setHeaderConnection($connection)
	{
		$this->headers['Connection'] = $connection;
	}

	public function buildHeader()
	{
		$headers = array();
		foreach ($this->headers as $key => $value) 
		{
			$headers[] = $key . ": ". $value;
		}

		$this->setHeaderOneHit($headers);
	}

	public function setOpt($options, $value)
	{
		$this->options[$options] = $value;
	}

	public function buildOpt()
	{
		$this->curlopt = curl_setopt_array($this->curl, $this->options);
	}

	public function exec()
	{
		$response = curl_exec($this->curl);

		return $response;
	}

	public function getInfo($option = "")
	{
		$info = curl_getinfo($this->curl, $option);
		return $info;
	}

	/*
	@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
	@												   @
	@	To get response header you must enable Header  @
	@												   @
	@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
	*/

	public function getHeaderResponse()
	{
		$header = substr($this->exec(), 0, $this->getInfo(CURLINFO_HEADER_SIZE));

		return $header;
	}

	public function getBodyResponse()
	{
		$body = substr($this->exec(), $this->getInfo(CURLINFO_HEADER_SIZE));

		return $body;
	}

	public function close()
	{
		curl_close($this->curl);
	}

	public function buildHttpPost($data = array())
	{
		$data = http_build_query($data);

		return $data;
	}

	public function buildJsonPost($data = array())
	{
		$data = json_encode($data)

		return $data;
	}
}

?>
