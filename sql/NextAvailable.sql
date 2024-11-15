WITH RECURSIVE dates AS (
    SELECT CURDATE() AS date
    UNION ALL
    SELECT date + INTERVAL 1 DAY
    FROM dates
    WHERE date < CURDATE() + INTERVAL @number_of_days DAY
),
next_available AS (
    SELECT s.StudioID, s.Studio_name, s.City, s.Postal_code, s.Street, s.street_no, s.Type, s.Price, d.date
    FROM studio s
    CROSS JOIN dates d
    LEFT JOIN reservation r ON s.StudioID = r.StudioID AND r.Reservation_Date = d.date
    WHERE r.Reservation_Date IS NULL
)
SELECT StudioID, Studio_name, Postal_code, MIN(date) AS Next_Available_Date
FROM next_available
WHERE StudioID LIKE @specific_studio_id
GROUP BY StudioID, Studio_name, Postal_code
ORDER BY StudioID, Next_Available_Date
LIMIT 5;