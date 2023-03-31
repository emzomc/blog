<h2>Reviews</h2>
                    
                        <form method="POST" action="/posts/{{ $post->slug }}/review"
                            class="border border-gray-100 p-6 rounded-xl">
                            @csrf
                            <header>
                                <h5>Leave a Review</h5>
                            </header>
                            <div class="mt-6 mb-6">
                                <textarea name="body" class="w-full text-sm focus:outline-none focus:ring" rows="5"
                                    placeholder="Leave your review here"></textarea>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col mt-4">
                                    <div class="form-group row">
                                        <div class="col">
                                            <div class="rate">
                                                <input type="radio" id="star5" class="rate" name="rating"
                                                    value="5" />
                                                <label for="star5" title="text">5 stars</label>
                                                <input type="radio" checked id="star4" class="rate" name="rating"
                                                    value="4" />
                                                <label for="star4" title="text">4 stars</label>
                                                <input type="radio" id="star3" class="rate" name="rating"
                                                    value="3" />
                                                <label for="star3" title="text">3 stars</label>
                                                <input type="radio" id="star2" class="rate" name="rating"
                                                    value="2">
                                                <label for="star2" title="text">2 stars</label>
                                                <input type="radio" id="star1" class="rate" name="rating"
                                                    value="1" />
                                                <label for="star1" title="text">1 star</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <button class="btn btn-info" type="submit">Leave Review</button>
                        </form>