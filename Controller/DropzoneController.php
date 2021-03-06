<?php

namespace Oneup\UploaderBundle\Controller;

use Symfony\Component\HttpFoundation\File\Exception\UploadException;

use Oneup\UploaderBundle\Controller\AbstractController;
use Oneup\UploaderBundle\Uploader\Response\EmptyResponse;

class DropzoneController extends AbstractController
{
	public function upload()
	{
		$request = $this->container->get('request');
		$response = new EmptyResponse();
		$files = $this->getFiles($request->files);

		if (!count($files)) {
			$this->dispatchEmptyUploadEvent($response, $request);
		} else {
			foreach ($files as $file) {
				try {
					$this->handleUpload($file, $response, $request);
				} catch (UploadException $e) {
					$this->errorHandler->addException($response, $e);
				}
			}
		}

		return $this->createSupportedJsonResponse($response->assemble());
	}
}
