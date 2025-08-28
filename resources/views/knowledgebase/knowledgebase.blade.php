@extends('layout.master')

@section('main_content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Knowledgebase</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"> <i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Knowledgebase</li>
                        <li class="breadcrumb-item active">Knowledgebase</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid faq-section">
        <div class="row">
            <div class="col-12">
                <div class="knowledgebase-bg"><img class="bg-img-cover bg-center"
                        src="{{ asset('assets/images/knowledgebase/bg_1.jpg') }}" alt="looginpage"></div>
                <div class="knowledgebase-search">
                    <div>
                        <h3>How Can I help you?</h3>
                        <form class="form-inline" action="#" method="get">
                            <div class="form-group w-100 mb-0"><i data-feather="search"></i>
                                <input class="form-control-plaintext w-100" type="text" placeholder="Type question here"
                                    title="">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6 box-col-33">
                <div class="card bg-primary">
                  <div class="card-body">
                    <div class="d-flex faq-widgets">
                      <div class="flex-grow-1">
                        <h4>Articles</h4>
                        <p class="mb-0">How little experience or technical knowledge you currently have. The web is a very big place, and if you are the typical internet user, you probably visit several websites every day.</p>
                      </div><i data-feather="book-open"></i>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-4 col-md-6 box-col-33">
                <div class="card bg-primary">
                  <div class="card-body">
                    <div class="d-flex faq-widgets">
                      <div class="flex-grow-1">
                        <h4>Knowledgebase</h4>
                        <p class="mb-0">A Website Designing course enables learners to use essential designing and programming tools required to do the job. The curriculum is a blend of various themes.</p>
                      </div><i data-feather="aperture"></i>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-4 col-lg-12 box-col-33">
                <div class="card bg-primary">
                  <div class="card-body">
                    <div class="d-flex faq-widgets">
                      <div class="flex-grow-1">
                        <h4>Support</h4>
                        <p class="mb-0">The customer support industry is renaissance. Customer support as a specialty is coming into its own, offering companies a competitive advantage that’s difficult to copy.</p>
                      </div><i data-feather="file-text"></i>
                    </div>
                  </div>
                </div>
              </div>
            <div class="col-lg-12 featured-tutorial">
                <div class="header-faq">
                    <h4 class="mb-0">Featured Tutorials</h4>
                </div>
                <div class="row">
                    <div class="col-xxl-3 col-xl-4 col-sm-6 box-col-3">
                        <div class="card features-faq product-box">
                            <div class="faq-image product-img"><img class="img-fluid"
                                    src="{{ asset('assets/images/faq/1.jpg') }}" alt="">
                                <div class="product-hover">
                                    <ul>
                                        <li><a href="{{ route('knowledge_detail') }}"><i class="icon-link"></i></a></li>
                                        <li><a href="{{ route('knowledge_detail') }}"><i class="icon-import"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body"><a href="{{ route('knowledge_detail') }}">
                                    <h6> Web Design</h6>
                                </a>
                                <p class="mb-0">A Web Designing course belongs to the field of Computer Science and IT. It enables students to learn</p>
                            </div>
                            <div class="card-footer"><span>Jan 08, 2022</span>
                                <ul class="pull-right">
                                    <li><i class="fa fa-star font-primary"></i></li>
                                    <li><i class="fa fa-star font-primary"></i></li>
                                    <li><i class="fa fa-star font-primary"></i></li>
                                    <li><i class="fa fa-star font-primary"></i></li>
                                    <li><i class="fa fa-star font-primary"></i></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-xl-4 col-sm-6 box-col-3">
                        <div class="card features-faq product-box">
                            <div class="faq-image product-img"><img class="img-fluid"
                                    src="{{ asset('assets/images/faq/2.jpg') }}" alt="">
                                <div class="product-hover">
                                    <ul>
                                        <li><a href="{{ route('knowledge_detail') }}"><i class="icon-link"></i></a></li>
                                        <li><a href="{{ route('knowledge_detail') }}"><i class="icon-import"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body"><a href="{{ route('knowledge_detail') }}">
                                    <h6>Web Development</h6>
                                </a>
                                <p class="mb-0">This course is designed to start you on a path toward future studies in web development and design.</p>
                            </div>
                            <div class="card-footer"><span>Feb 18, 2022</span>
                                <ul class="pull-right">
                                    <li><i class="fa fa-star font-primary"></i></li>
                                    <li><i class="fa fa-star font-primary"></i></li>
                                    <li><i class="fa fa-star font-primary"></i></li>
                                    <li><i class="fa fa-star font-primary"></i></li>
                                    <li><i class="fa fa-star-o font-primary"></i></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-xl-4 col-sm-6 box-col-3">
                        <div class="card features-faq product-box">
                            <div class="faq-image product-img"><img class="img-fluid"
                                    src="{{ asset('assets/images/faq/3.jpg') }}" alt="">
                                <div class="product-hover">
                                    <ul>
                                        <li><a href="{{ route('knowledge_detail') }}"><i class="icon-link"></i></a></li>
                                        <li><a href="{{ route('knowledge_detail') }}"><i class="icon-import"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body"><a href="{{ route('knowledge_detail') }}">
                                    <h6>UI Design</h6>
                                </a>
                                <p class="mb-0">User interface design (UI) is the design for machines and software, such as mobile devices, computers.</p>
                            </div>
                            <div class="card-footer"><span>Aug 04, 2022</span>
                                <ul class="pull-right">
                                    <li><i class="fa fa-star font-primary"></i></li>
                                    <li><i class="fa fa-star font-primary"></i></li>
                                    <li><i class="fa fa-star font-primary"></i></li>
                                    <li><i class="fa fa-star font-primary"></i></li>
                                    <li><i class="fa fa-star font-primary"></i></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-xl-4 col-sm-6 box-col-3">
                        <div class="card features-faq product-box">
                            <div class="faq-image product-img"><img class="img-fluid"
                                    src="{{ asset('assets/images/faq/4.jpg') }}" alt="">
                                <div class="product-hover">
                                    <ul>
                                        <li><a href="{{ route('knowledge_detail') }}"><i class="icon-link"></i></a></li>
                                        <li><a href="{{ route('knowledge_detail') }}"><i class="icon-import"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body"><a href="{{ route('knowledge_detail') }}">
                                    <h6>UX Design</h6>
                                </a>
                                <p class="mb-0">A Web Designing course belongs to the field of Computer Science and IT. It enables students to learn</p>
                            </div>
                            <div class="card-footer"><span>May 21, 2022</span>
                                <ul class="pull-right">
                                    <li><i class="fa fa-star font-primary"></i></li>
                                    <li><i class="fa fa-star font-primary"></i></li>
                                    <li><i class="fa fa-star font-primary"></i></li>
                                    <li><i class="fa fa-star font-primary"></i></li>
                                    <li><i class="fa fa-star-half-o font-primary"></i></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-xl-4 col-sm-6 box-col-3">
                        <div class="card features-faq product-box">
                            <div class="faq-image product-img"><img class="img-fluid"
                                    src="{{ asset('assets/images/faq/3.jpg') }}" alt="">
                                <div class="product-hover">
                                    <ul>
                                        <li><a href="{{ route('knowledge_detail') }}"><i class="icon-link"></i></a></li>
                                        <li><a href="{{ route('knowledge_detail') }}"><i class="icon-import"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body"><a href="{{ route('knowledge_detail') }}">
                                    <h6>UI Design</h6>
                                </a>
                                <p class="mb-0">User Experience design (UX) is the design for machines and software, such as mobile devices, computers.</p>
                            </div>
                            <div class="card-footer"><span>June 08, 2022</span>
                                <ul class="pull-right">
                                    <li><i class="fa fa-star font-primary"></i></li>
                                    <li><i class="fa fa-star font-primary"></i></li>
                                    <li><i class="fa fa-star font-primary"></i></li>
                                    <li><i class="fa fa-star font-primary"></i></li>
                                    <li><i class="fa fa-star font-primary"></i></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-xl-4 col-sm-6 box-col-3">
                        <div class="card features-faq product-box">
                            <div class="faq-image product-img"><img class="img-fluid"
                                    src="{{ asset('assets/images/faq/4.jpg') }}" alt="">
                                <div class="product-hover">
                                    <ul>
                                        <li><a href="{{ route('knowledge_detail') }}"><i class="icon-link"></i></a></li>
                                        <li><a href="{{ route('knowledge_detail') }}"><i class="icon-import"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body"><a href="{{ route('knowledge_detail') }}">
                                    <h6>UX Design</h6>
                                </a>
                               <p class="mb-0">This course is designed to start you on a path toward future studies in web development and design.</p>
                            </div>
                            <div class="card-footer"><span>Sept 19, 2022</span>
                                <ul class="pull-right">
                                    <li><i class="fa fa-star font-primary"></i></li>
                                    <li><i class="fa fa-star font-primary"></i></li>
                                    <li><i class="fa fa-star font-primary"></i></li>
                                    <li><i class="fa fa-star font-primary"></i></li>
                                    <li><i class="fa fa-star-half-o font-primary"></i></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-xl-4 col-sm-6 box-col-3">
                        <div class="card features-faq product-box">
                            <div class="faq-image product-img"><img class="img-fluid"
                                    src="{{ asset('assets/images/faq/1.jpg') }}" alt="">
                                <div class="product-hover">
                                    <ul>
                                        <li><a href="{{ route('knowledge_detail') }}"><i class="icon-link"></i></a></li>
                                        <li><a href="{{ route('knowledge_detail') }}"><i class="icon-import"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body"><a href="{{ route('knowledge_detail') }}">
                                    <h6> Web Design</h6>
                                </a>
                                <p class="mb-0">Web designer is a craft where professionals create visual content to communicate though messages.</p>
                            </div>
                            <div class="card-footer"><span>Oct 25, 2022</span>
                                <ul class="pull-right">
                                    <li><i class="fa fa-star font-primary"></i></li>
                                    <li><i class="fa fa-star font-primary"></i></li>
                                    <li><i class="fa fa-star font-primary"></i></li>
                                    <li><i class="fa fa-star font-primary"></i></li>
                                    <li><i class="fa fa-star font-primary"></i></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-xl-4 col-sm-6 box-col-3">
                        <div class="card features-faq product-box">
                            <div class="faq-image product-img"><img class="img-fluid"
                                    src="{{ asset('assets/images/faq/2.jpg') }}" alt="">
                                <div class="product-hover">
                                    <ul>
                                        <li><a href="{{ route('knowledge_detail') }}"><i class="icon-link"></i></a></li>
                                        <li><a href="{{ route('knowledge_detail') }}"><i class="icon-import"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body"><a href="{{ route('knowledge_detail') }}">
                                    <h6>Web Development</h6>
                                </a>
                               <p class="mb-0">A content developer is typically professional who creates digital and physical content including blog posts,</p>
                            </div>
                            <div class="card-footer"><span>Dec 15, 2022</span>
                                <ul class="pull-right">
                                    <li><i class="fa fa-star font-primary"></i></li>
                                    <li><i class="fa fa-star font-primary"></i></li>
                                    <li><i class="fa fa-star font-primary"></i></li>
                                    <li><i class="fa fa-star font-primary"></i></li>
                                    <li><i class="fa fa-star-o font-primary"></i></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
