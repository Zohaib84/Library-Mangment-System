<div class="currently-market">
  <div class="container">
    <div class="row">
      <div class="col-lg-6">
        <div class="section-heading">
          <div class="line-dec"></div>
          <h2><em>Items</em> Currently In The Market.</h2>
        </div>
      </div>
      
      <div class="col-lg-6">
        <div class="filters">
          <ul>
            <li data-filter="*" class="active">All Books</li>
            <li data-filter=".msc">Popular</li>
            <li data-filter=".dig">Latest</li>
          </ul>
        </div>
      </div>

      <div class="col-lg-12">
        <div class="row grid">

          <!-- Start the Loop for Each Book -->
          @foreach ($data as $item)
          <div class="col-lg-6 currently-market-item all msc">
            <div class="item">
              <div class="left-image">
                <img src="book/{{ $item->book_img ?? 'default-book.jpg' }}" alt="Book Image" style="border-radius: 20px; min-width: 195px;">
              </div>
              <div class="right-content">
                <h4>{{ $item->title }}</h4>
                <span class="author">
                  <img src="author/{{ $item->author_img ?? 'default-author.jpg' }}" alt="Author Image" style="max-width: 50px; border-radius: 50%;">
                  <h6>{{ $item->author_name }}</h6>
                </span>
                <div class="line-dec"></div>
                <span class="bid">
                  Current Available<br><strong>{{ $item->quantity }}</strong><br> 
                </span>
                <span class="ends">
                  Price<br><strong>{{ $item->price }}</strong><br>
                </span>

                <div class="text-button">
                  <a href="">View Book Details</a>
                </div>
                <br>
                <div>
                  <a href="{{ url('borrow_book', $item->id) }}" class="btn btn-primary">Apply to Borrow</a>
                </div>
              </div>
            </div>
          </div>
          @endforeach
          <!-- End the Loop -->

        </div>
      </div>
    </div>
  </div>
</div>
