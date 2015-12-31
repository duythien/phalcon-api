**Feature in phanbook store**
-----------------------------

-   **Front End**

    -   **Users** (*Singleton*, *Factory Method*, *Decorator*)

	    -   Type
	
	        -   *Guest*
	
	            -   View Products
	
	        -   *Normal User*
	
	            -   Require Authentication
	
	            -   Install Products
	
	            -   Remove Installed Products
	
	            -   Active Products
	
	            -   Deactive Products
	
	            -   Clean Products
	
	            -   Comment Products
	            
	            -   Edit Comment
	
	        -   *Manufactor*
	
	            -   Require Authentication
	
	            -   Upload Products
	
	            -   Lock Products (Product can’t be delete, update)
	
	            -   Unlock Products (After one day/week, product can be delete,
	                update)
	
	            -   Rating development
	
	    -   Authentication
	
	    -   Cart
	
	        -   Require Authentication
	
	    -   **Products** (*Abstract Factory, Observer, State*)
	
	        -   Find Products
	
	        -   Group Products
	
	        -   List Products
	
	        -   Statistical
	
	            -   Top free products
	
	            -   Top purchase products
	
	        -   Rating products
	
	        -   Comment
	
	            -   Rating comment
	
	        -   Number install
	
	        -   Related products
	
	    -   **Payment** (*Adapter*)
	
	    -   **Rating**
	
	        -   1,2,3,4,5 Star
	
	        -   AVG Star
	
	    -   **Install Process** (*Builder*)
	
	        -   Require Authentication
	
	        -   Require Permission (*Decorator*)
	
-   **Back End**

    -   **Users**

        -   Type

            -   *Modern*

                -   Management Products

            -   *Administrator*

                -   Management Products

                -   Management Users

            -   *Normal Users*

            -   *Manufactor*

        -   Authentication

    -   **Management Products**

        -   Filter Products

            -   Filter by Human

            -   Filter by Machine

    -   **Management Users**

        -   Add/Edit/Delete/Active/Deactive (State Pattern)

            -   Users

            -   Manufactor

            -   Modern

    -   **Statistical**

        -   System report
