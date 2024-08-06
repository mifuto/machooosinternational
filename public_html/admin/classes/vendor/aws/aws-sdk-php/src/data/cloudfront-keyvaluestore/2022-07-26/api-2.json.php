<?php
// This file was auto-generated from sdk-root/src/data/cloudfront-keyvaluestore/2022-07-26/api-2.json
return [ 'version' => '2.0', 'metadata' => [ 'apiVersion' => '2022-07-26', 'endpointPrefix' => 'cloudfront-keyvaluestore', 'jsonVersion' => '1.1', 'protocol' => 'rest-json', 'serviceFullName' => 'Amazon CloudFront KeyValueStore', 'serviceId' => 'CloudFront KeyValueStore', 'signatureVersion' => 'v4', 'signingName' => 'cloudfront-keyvaluestore', 'uid' => 'cloudfront-keyvaluestore-2022-07-26', ], 'operations' => [ 'DeleteKey' => [ 'name' => 'DeleteKey', 'http' => [ 'method' => 'DELETE', 'requestUri' => '/key-value-stores/{KvsARN}/keys/{Key}', 'responseCode' => 200, ], 'input' => [ 'shape' => 'DeleteKeyRequest', ], 'output' => [ 'shape' => 'DeleteKeyResponse', ], 'errors' => [ [ 'shape' => 'ConflictException', ], [ 'shape' => 'ValidationException', ], [ 'shape' => 'InternalServerException', ], [ 'shape' => 'ServiceQuotaExceededException', ], [ 'shape' => 'ResourceNotFoundException', ], [ 'shape' => 'AccessDeniedException', ], ], 'idempotent' => true, ], 'DescribeKeyValueStore' => [ 'name' => 'DescribeKeyValueStore', 'http' => [ 'method' => 'GET', 'requestUri' => '/key-value-stores/{KvsARN}', 'responseCode' => 200, ], 'input' => [ 'shape' => 'DescribeKeyValueStoreRequest', ], 'output' => [ 'shape' => 'DescribeKeyValueStoreResponse', ], 'errors' => [ [ 'shape' => 'ConflictException', ], [ 'shape' => 'InternalServerException', ], [ 'shape' => 'ResourceNotFoundException', ], [ 'shape' => 'AccessDeniedException', ], ], ], 'GetKey' => [ 'name' => 'GetKey', 'http' => [ 'method' => 'GET', 'requestUri' => '/key-value-stores/{KvsARN}/keys/{Key}', 'responseCode' => 200, ], 'input' => [ 'shape' => 'GetKeyRequest', ], 'output' => [ 'shape' => 'GetKeyResponse', ], 'errors' => [ [ 'shape' => 'ConflictException', ], [ 'shape' => 'InternalServerException', ], [ 'shape' => 'ResourceNotFoundException', ], [ 'shape' => 'AccessDeniedException', ], ], ], 'ListKeys' => [ 'name' => 'ListKeys', 'http' => [ 'method' => 'GET', 'requestUri' => '/key-value-stores/{KvsARN}/keys', 'responseCode' => 200, ], 'input' => [ 'shape' => 'ListKeysRequest', ], 'output' => [ 'shape' => 'ListKeysResponse', ], 'errors' => [ [ 'shape' => 'ConflictException', ], [ 'shape' => 'ValidationException', ], [ 'shape' => 'InternalServerException', ], [ 'shape' => 'ResourceNotFoundException', ], [ 'shape' => 'AccessDeniedException', ], ], ], 'PutKey' => [ 'name' => 'PutKey', 'http' => [ 'method' => 'PUT', 'requestUri' => '/key-value-stores/{KvsARN}/keys/{Key}', 'responseCode' => 200, ], 'input' => [ 'shape' => 'PutKeyRequest', ], 'output' => [ 'shape' => 'PutKeyResponse', ], 'errors' => [ [ 'shape' => 'ConflictException', ], [ 'shape' => 'ValidationException', ], [ 'shape' => 'InternalServerException', ], [ 'shape' => 'ServiceQuotaExceededException', ], [ 'shape' => 'ResourceNotFoundException', ], [ 'shape' => 'AccessDeniedException', ], ], 'idempotent' => true, ], 'UpdateKeys' => [ 'name' => 'UpdateKeys', 'http' => [ 'method' => 'POST', 'requestUri' => '/key-value-stores/{KvsARN}/keys', 'responseCode' => 200, ], 'input' => [ 'shape' => 'UpdateKeysRequest', ], 'output' => [ 'shape' => 'UpdateKeysResponse', ], 'errors' => [ [ 'shape' => 'ConflictException', ], [ 'shape' => 'ValidationException', ], [ 'shape' => 'InternalServerException', ], [ 'shape' => 'ServiceQuotaExceededException', ], [ 'shape' => 'ResourceNotFoundException', ], [ 'shape' => 'AccessDeniedException', ], ], 'idempotent' => true, ], ], 'shapes' => [ 'AccessDeniedException' => [ 'type' => 'structure', 'members' => [ 'Message' => [ 'shape' => 'String', ], ], 'error' => [ 'httpStatusCode' => 403, 'senderFault' => true, ], 'exception' => true, ], 'ConflictException' => [ 'type' => 'structure', 'members' => [ 'Message' => [ 'shape' => 'String', ], ], 'error' => [ 'httpStatusCode' => 409, 'senderFault' => true, ], 'exception' => true, ], 'DeleteKeyRequest' => [ 'type' => 'structure', 'required' => [ 'KvsARN', 'Key', 'IfMatch', ], 'members' => [ 'KvsARN' => [ 'shape' => 'KvsARN', 'contextParam' => [ 'name' => 'KvsARN', ], 'location' => 'uri', 'locationName' => 'KvsARN', ], 'Key' => [ 'shape' => 'Key', 'location' => 'uri', 'locationName' => 'Key', ], 'IfMatch' => [ 'shape' => 'Etag', 'location' => 'header', 'locationName' => 'If-Match', ], ], ], 'DeleteKeyRequestListItem' => [ 'type' => 'structure', 'required' => [ 'Key', ], 'members' => [ 'Key' => [ 'shape' => 'Key', ], ], ], 'DeleteKeyRequestsList' => [ 'type' => 'list', 'member' => [ 'shape' => 'DeleteKeyRequestListItem', ], ], 'DeleteKeyResponse' => [ 'type' => 'structure', 'required' => [ 'ItemCount', 'TotalSizeInBytes', 'ETag', ], 'members' => [ 'ItemCount' => [ 'shape' => 'Integer', ], 'TotalSizeInBytes' => [ 'shape' => 'Long', ], 'ETag' => [ 'shape' => 'Etag', 'location' => 'header', 'locationName' => 'ETag', ], ], ], 'DescribeKeyValueStoreRequest' => [ 'type' => 'structure', 'required' => [ 'KvsARN', ], 'members' => [ 'KvsARN' => [ 'shape' => 'KvsARN', 'contextParam' => [ 'name' => 'KvsARN', ], 'location' => 'uri', 'locationName' => 'KvsARN', ], ], ], 'DescribeKeyValueStoreResponse' => [ 'type' => 'structure', 'required' => [ 'ItemCount', 'TotalSizeInBytes', 'KvsARN', 'Created', 'ETag', ], 'members' => [ 'ItemCount' => [ 'shape' => 'Integer', ], 'TotalSizeInBytes' => [ 'shape' => 'Long', ], 'KvsARN' => [ 'shape' => 'KvsARN', ], 'Created' => [ 'shape' => 'Timestamp', ], 'ETag' => [ 'shape' => 'Etag', 'location' => 'header', 'locationName' => 'ETag', ], 'LastModified' => [ 'shape' => 'Timestamp', ], ], ], 'Etag' => [ 'type' => 'string', ], 'GetKeyRequest' => [ 'type' => 'structure', 'required' => [ 'KvsARN', 'Key', ], 'members' => [ 'KvsARN' => [ 'shape' => 'KvsARN', 'contextParam' => [ 'name' => 'KvsARN', ], 'location' => 'uri', 'locationName' => 'KvsARN', ], 'Key' => [ 'shape' => 'Key', 'location' => 'uri', 'locationName' => 'Key', ], ], ], 'GetKeyResponse' => [ 'type' => 'structure', 'required' => [ 'Key', 'Value', 'ItemCount', 'TotalSizeInBytes', ], 'members' => [ 'Key' => [ 'shape' => 'Key', ], 'Value' => [ 'shape' => 'Value', ], 'ItemCount' => [ 'shape' => 'Integer', ], 'TotalSizeInBytes' => [ 'shape' => 'Long', ], ], ], 'Integer' => [ 'type' => 'integer', 'box' => true, ], 'InternalServerException' => [ 'type' => 'structure', 'members' => [ 'Message' => [ 'shape' => 'String', ], ], 'error' => [ 'httpStatusCode' => 500, ], 'exception' => true, 'fault' => true, ], 'Key' => [ 'type' => 'string', 'max' => 1024, 'min' => 1, ], 'KvsARN' => [ 'type' => 'string', 'max' => 2048, 'min' => 1, ], 'ListKeysRequest' => [ 'type' => 'structure', 'required' => [ 'KvsARN', ], 'members' => [ 'KvsARN' => [ 'shape' => 'KvsARN', 'contextParam' => [ 'name' => 'KvsARN', ], 'location' => 'uri', 'locationName' => 'KvsARN', ], 'NextToken' => [ 'shape' => 'String', 'location' => 'querystring', 'locationName' => 'NextToken', ], 'MaxResults' => [ 'shape' => 'ListKeysRequestMaxResultsInteger', 'location' => 'querystring', 'locationName' => 'MaxResults', ], ], ], 'ListKeysRequestMaxResultsInteger' => [ 'type' => 'integer', 'box' => true, 'max' => 50, 'min' => 1, ], 'ListKeysResponse' => [ 'type' => 'structure', 'members' => [ 'NextToken' => [ 'shape' => 'String', ], 'Items' => [ 'shape' => 'ListKeysResponseList', ], ], ], 'ListKeysResponseList' => [ 'type' => 'list', 'member' => [ 'shape' => 'ListKeysResponseListItem', ], ], 'ListKeysResponseListItem' => [ 'type' => 'structure', 'required' => [ 'Key', 'Value', ], 'members' => [ 'Key' => [ 'shape' => 'Key', ], 'Value' => [ 'shape' => 'Value', ], ], ], 'Long' => [ 'type' => 'long', 'box' => true, ], 'PutKeyRequest' => [ 'type' => 'structure', 'required' => [ 'Key', 'Value', 'KvsARN', 'IfMatch', ], 'members' => [ 'Key' => [ 'shape' => 'Key', 'location' => 'uri', 'locationName' => 'Key', ], 'Value' => [ 'shape' => 'Value', ], 'KvsARN' => [ 'shape' => 'KvsARN', 'contextParam' => [ 'name' => 'KvsARN', ], 'location' => 'uri', 'locationName' => 'KvsARN', ], 'IfMatch' => [ 'shape' => 'Etag', 'location' => 'header', 'locationName' => 'If-Match', ], ], ], 'PutKeyRequestListItem' => [ 'type' => 'structure', 'required' => [ 'Key', 'Value', ], 'members' => [ 'Key' => [ 'shape' => 'Key', ], 'Value' => [ 'shape' => 'Value', ], ], ], 'PutKeyRequestsList' => [ 'type' => 'list', 'member' => [ 'shape' => 'PutKeyRequestListItem', ], ], 'PutKeyResponse' => [ 'type' => 'structure', 'required' => [ 'ItemCount', 'TotalSizeInBytes', 'ETag', ], 'members' => [ 'ItemCount' => [ 'shape' => 'Integer', ], 'TotalSizeInBytes' => [ 'shape' => 'Long', ], 'ETag' => [ 'shape' => 'Etag', 'location' => 'header', 'locationName' => 'ETag', ], ], ], 'ResourceNotFoundException' => [ 'type' => 'structure', 'members' => [ 'Message' => [ 'shape' => 'String', ], ], 'error' => [ 'httpStatusCode' => 404, 'senderFault' => true, ], 'exception' => true, ], 'ServiceQuotaExceededException' => [ 'type' => 'structure', 'members' => [ 'Message' => [ 'shape' => 'String', ], ], 'error' => [ 'httpStatusCode' => 402, 'senderFault' => true, ], 'exception' => true, ], 'String' => [ 'type' => 'string', ], 'Timestamp' => [ 'type' => 'timestamp', ], 'UpdateKeysRequest' => [ 'type' => 'structure', 'required' => [ 'KvsARN', 'IfMatch', ], 'members' => [ 'KvsARN' => [ 'shape' => 'KvsARN', 'contextParam' => [ 'name' => 'KvsARN', ], 'location' => 'uri', 'locationName' => 'KvsARN', ], 'IfMatch' => [ 'shape' => 'Etag', 'location' => 'header', 'locationName' => 'If-Match', ], 'Puts' => [ 'shape' => 'PutKeyRequestsList', ], 'Deletes' => [ 'shape' => 'DeleteKeyRequestsList', ], ], ], 'UpdateKeysResponse' => [ 'type' => 'structure', 'required' => [ 'ItemCount', 'TotalSizeInBytes', 'ETag', ], 'members' => [ 'ItemCount' => [ 'shape' => 'Integer', ], 'TotalSizeInBytes' => [ 'shape' => 'Long', ], 'ETag' => [ 'shape' => 'Etag', 'location' => 'header', 'locationName' => 'ETag', ], ], ], 'ValidationException' => [ 'type' => 'structure', 'members' => [ 'Message' => [ 'shape' => 'String', ], ], 'error' => [ 'httpStatusCode' => 400, 'senderFault' => true, ], 'exception' => true, ], 'Value' => [ 'type' => 'string', 'sensitive' => true, ], ],];
