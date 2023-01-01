SELECT m.itemName AS NAME, SUM(quantity) AS TOTAL,SUM(o.amount) AS TOTALPRICE FROM item m, order_detail od, orders o  
WHERE m.item_id=od.item_id AND o.order_id=od.order_id AND o.orderDate IN (SELECT orderDate FROM orders WHERE orderDate = '2022-11-09' ) 
GROUP BY od.item_id ORDER BY SUM(quantity) DESC;
					

SELECT m.itemName AS NAME, SUM(quantity) AS TOTAL,SUM(o.amount) AS TOTALPRICE FROM item m, order_detail od, orders o  
WHERE m.item_id=od.item_id AND o.order_id=od.order_id AND o.orderDate  AND MONTH(o.orderDate)='11' GROUP BY od.item_id ORDER BY SUM(quantity) DESC;


SELECT m.itemName AS NAME, SUM(quantity) AS TOTAL,SUM(o.amount) AS TOTALPRICE FROM item m, order_detail od, orders o  
WHERE m.item_id=od.item_id AND o.order_id=od.order_id AND o.orderDate  AND YEAR(o.orderDate)='2022' GROUP BY od.item_id ORDER BY SUM(quantity) DESC;

