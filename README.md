# Clubroom booking system for our building
> Dedicated to the community members

This is the booking system for the people of Aisakkaankatu building. In HOAS's booking system there is no booking system for `Clubroom` so we thought to make one such system so everyone in this building can book and enjoy clubroom slots.

## Features
- Admins can see the people who booked the slots of the `Clubroom`.
- People can login and logout
- See available vacant slots
- People can find out the members who has key of the clubroom 

## Technology
- Laravel (Backend)
  - Authentication
  - ORM(Object Relational Mapping)
- CSS (Tailwind CSS)
- JS (Javascript)


## Testing Query for Joining table as of development Phase
```sql
SELECT 
    b.id,
    b.booking_date,
    u.name AS user_name,
    ts.start_time,
    cr.name AS CLub_room
FROM bookings b
JOIN users u ON b.user_id = u.id
JOIN time_slots ts ON b.time_slot_id = ts.id
JOIN club_rooms cr ON b.club_room_id = cr.id;

```