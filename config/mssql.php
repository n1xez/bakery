<?php

return [
    'host' => env('DB_FOREIGN_HOST', 'localhost'),
    'port' => env('DB_FOREIGN_PORT', '1433'),
    'database' => env('DB_FOREIGN_DATABASE', 'Resto'),
    'username' => env('DB_FOREIGN_USERNAME', 'sa'),
    'password' => env('DB_FOREIGN_PASSWORD', ''),
    'sql' => 'SELECT 
	result.store storage,
	result.product product,
	CAST(CAST(store.xml as xml).query(\'/r/name/customValue/node()\') as nvarchar(max)) as storageName,
	CAST(CAST(product.xml as xml).query(\'/r/name/customValue/node()\') as nvarchar(max)) as productName,
	result.amount as amount
FROM (
	SELECT query.store, query.product, sum(query.amount) amount
	FROM (
		SELECT document.store store, item.product product, sum(item.amount) amount
		FROM Resto.dbo.ProductionDocument document
		LEFT JOIN Resto.dbo.ProductionDocumentItem item ON document.id = item.document_id
		WHERE dateIncoming between CAST(CAST(GETDATE() AS DATE) AS DATETIME) AND dateadd(SS, -1, CAST(CAST(dateadd(DD,1,GETDATE()) AS DATE) AS DATETIME))
		GROUP BY document.store, item.product

		UNION
		SELECT item.store store, item.product product, -sum(item.amount) amount
		FROM Resto.dbo.SalesDocument document
		LEFT JOIN Resto.dbo.SalesDocumentItem item ON document.id = item.invoice_id
		WHERE dateIncoming between CAST(CAST(GETDATE() AS DATE) AS DATETIME) AND dateadd(SS, -1, CAST(CAST(dateadd(DD,1,GETDATE()) AS DATE) AS DATETIME))
		GROUP BY item.store, item.product

		UNION
		SELECT document.store store, item.product product, -sum(item.amount) amount
		FROM Resto.dbo.WriteoffDocument document
		LEFT JOIN Resto.dbo.WriteoffDocumentItem item ON document.id = item.writeoffDocument_id
		WHERE dateIncoming between CAST(CAST(GETDATE() AS DATE) AS DATETIME) AND dateadd(SS, -1, CAST(CAST(dateadd(DD,1,GETDATE()) AS DATE) AS DATETIME))
		GROUP BY document.store, item.product

		UNION
		SELECT document.storeFrom store, item.product product, -sum(item.amount) amount
		FROM Resto.dbo.InternalTransfer document
		LEFT JOIN Resto.dbo.InternalTransferItem item ON document.id = item.transfer_id
		WHERE dateIncoming between CAST(CAST(GETDATE() AS DATE) AS DATETIME) AND dateadd(SS, -1, CAST(CAST(dateadd(DD,1,GETDATE()) AS DATE) AS DATETIME))
		GROUP BY document.storeFrom, item.product

		UNION
		SELECT document.storeTo store, item.product product, sum(item.amount) amount
		FROM Resto.dbo.InternalTransfer document
		LEFT JOIN Resto.dbo.InternalTransferItem item ON document.id = item.transfer_id
		WHERE dateIncoming between CAST(CAST(GETDATE() AS DATE) AS DATETIME) AND dateadd(SS, -1, CAST(CAST(dateadd(DD,1,GETDATE()) AS DATE) AS DATETIME))
		GROUP BY document.storeTo, item.product
	) query
	GROUP BY query.store, query.product
) result
LEFT JOIN Resto.dbo.entity store ON result.store = store.id
LEFT JOIN Resto.dbo.entity product ON result.product = product.id;',
];