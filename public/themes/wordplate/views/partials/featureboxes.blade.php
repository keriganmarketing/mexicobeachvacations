<div class="feature-box-section">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-4 text-white box-container">
                <div class="feature-box feat-one">
                    <h3>{{ $featureBox1['title'] }}</h3>
                    <p>{{ $featureBox1['text'] }}</p>
                    <a class="btn btn-lg btn-outline-white btn-rounded" href="{{ $featureBox1['link']['url'] }}" >{{ $featureBox1['link']['title'] }} &nbsp; <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 text-white box-container">
                <div class="feature-box feat-two">
                    <h3 class="text-orange">{{ $featureBox2['title'] }}</h3>
                    <p>{{ $featureBox2['text'] }}</p>
                    <a class="btn btn-lg btn-outline-white btn-rounded" href="{{ $featureBox2['link']['url'] }}" >{{ $featureBox2['link']['title'] }} &nbsp; <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                </div>
            </div>
            <div class="col-lg-4 text-white box-container">
                <div class="feature-box feat-three">
                    <h3>{{ $featureBox3['title'] }}</h3>
                    <p>{{ $featureBox3['text'] }}</p>
                    <a class="btn btn-lg btn-outline-white btn-rounded" href="{{ $featureBox3['link']['url'] }}" >{{ $featureBox3['link']['title'] }} &nbsp; <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>