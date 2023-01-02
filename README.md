# Solo Website Project

Implement a shopping site to support Cara with handling painting orders. As with all specifications there are likely to be elements that are unclear - you should identify these and raise them in lectures/Mattermost. Clarifications may be made (additions in red, removals in grey).

Base Solution - 18/40
Implement the following:

A database driven shop front page (e.g. index.html or index.php), that:
Lists the current art in the database (see No.3);
Has an order button for each piece of art that takes the user to a form to place an order for that artwork (No.2). Note: there is no basket - just single art order form.
An order form that includes fields for name, phone-number, email, postal-address and shows all details of the selected painting (name, completion date, size, price and Cara's textual description). On completion of this form the order should be acknowledged and added to the orders database (No.4). Note: Cara will set a single cost for each piece of art that includes VAT, postage and packing so there is no need to handle these separately. 
An art database table that contains the name, date of completion, width (mm), height (mm), price (£) and a textual description of each piece of art along with an ID.
An orders database table to store orders with suitable code to add orders in response to the order form (No.2);
An admin section (e.g. admin.php) for Cara to view the list of orders, add details of new paintings and remove orders. This should be password protected with a fixed password YouAskMeHow22  (fixed passwords are not good practice normally!).
Pages should pass HTML5 validation tests with all images having suitable alt-tags etc for accessibility. All code should be in a random character named directory on devweb2022

Pagination Extra - 2/40
Change the shop front to show 12 painting listings at a time with next and previous page buttons.

Art Extra - 6/40 
Add images to your art database table. Show thumbnails of the art on the main page along with their title. Show large (say half-screen) images on the order page. Images should not be stored in files but in the database itself using blobs (or longblobs). You should find sample images on the internet but use only Creative-Commons or copyright-free images. Please also scale the image - 750 x 750 pixels max is adequate for this assessment and won't overload the server.

Error Check Extra - 4/40 
Add error checking and form validation to the order form using best practice combination of HTML5, JavaScript and PHP.

All submissions will be marked on:  Artistic Impression and Technical Extensions - 10/40

Style the site to look fresh and artistic. All pages and images should be styled to appear nicely on a wide range of screen sizes. The whole site should have a professional feel. Marks will also be given for use of web libraries and frameworks (so long as the core functionality is still implemented) or additional technical components (e.g. a carousel of the art on the home page).

