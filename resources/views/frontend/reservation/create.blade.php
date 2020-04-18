@extends('frontend.layouts.layout')
@section('header')
@include('frontend.layouts.header')
@endsection

@section('main')
    
    <section class="section">
      <div class="empty-lg-115 empty-md-100 empty-sm-60 empty-xs-60"></div>
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-md-offset-3 col-xs-12">
              <div class="main-caption text-center color-type-2">
                <h2 class="h2">Book A Table</h2>
                <div class="empty-sm-55 empty-xs-25"></div>
                <form action="/" onsubmit="return MessageForm6();" method="post" id="messageForm6" class="reservation">
                  <div class="col-md-7">
                    <div class="input-field-icon">
                      <input type="text" class="input-field" placeholder="DD / MM / YY" name="data" required="">
                      <div class="icon">
                        <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 58 58" width="18px" height="18px" style="enable-background:new 0 0 58 58;" xml:space="preserve">
                        <g>
                          <path d="M42.899,4.5c-0.465-2.279-2.484-4-4.899-4c-0.553,0-1,0.447-1,1s0.447,1,1,1c1.654,0,3,1.346,3,3s-1.346,3-3,3
                            c-0.553,0-1,0.447-1,1s0.447,1,1,1c2.414,0,4.434-1.721,4.899-4H56v9H2v-9h14h3c0.553,0,1-0.447,1-1s-0.447-1-1-1h-1.816
                            c0.414-1.162,1.514-2,2.816-2c1.654,0,3,1.346,3,3s-1.346,3-3,3c-0.553,0-1,0.447-1,1s0.447,1,1,1c2.757,0,5-2.243,5-5
                            s-2.243-5-5-5c-2.414,0-4.434,1.721-4.899,4H0v13v40h58v-40v-13H42.899z M56,55.5H2v-38h54V55.5z"></path>
                          <path d="M26,2.5c1.654,0,3,1.346,3,3s-1.346,3-3,3c-0.553,0-1,0.447-1,1s0.447,1,1,1c2.757,0,5-2.243,5-5s-2.243-5-5-5
                            c-0.553,0-1,0.447-1,1S25.447,2.5,26,2.5z"></path>
                          <path d="M32,2.5c1.654,0,3,1.346,3,3s-1.346,3-3,3c-0.553,0-1,0.447-1,1s0.447,1,1,1c2.757,0,5-2.243,5-5s-2.243-5-5-5
                            c-0.553,0-1,0.447-1,1S31.447,2.5,32,2.5z"></path>
                          <circle cx="22" cy="24.5" r="1"></circle><circle cx="29" cy="24.5" r="1"></circle><circle cx="36" cy="24.5" r="1"></circle><circle cx="43" cy="24.5" r="1"></circle>
                          <circle cx="50" cy="24.5" r="1"></circle><circle cx="8" cy="32.5" r="1"></circle><circle cx="15" cy="32.5" r="1"></circle><circle cx="22" cy="32.5" r="1"></circle>
                          <circle cx="29" cy="32.5" r="1"></circle><circle cx="36" cy="32.5" r="1"></circle><circle cx="43" cy="32.5" r="1"></circle><circle cx="50" cy="32.5" r="1"></circle>
                          <circle cx="8" cy="39.5" r="1"></circle><circle cx="15" cy="39.5" r="1"></circle><circle cx="22" cy="39.5" r="1"></circle><circle cx="29" cy="39.5" r="1"></circle>
                          <circle cx="36" cy="39.5" r="1"></circle><circle cx="43" cy="39.5" r="1"></circle><circle cx="50" cy="39.5" r="1"></circle><circle cx="8" cy="47.5" r="1"></circle>
                          <circle cx="15" cy="47.5" r="1"></circle><circle cx="22" cy="47.5" r="1"></circle><circle cx="29" cy="47.5" r="1"></circle><circle cx="36" cy="47.5" r="1"></circle>
                        </g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g>
                        </svg>
                      </div>
                    </div>      
                    <div class="empty-sm-20  empty-xs-20"></div> 
                  </div>
                  <div class="col-md-5">
                    <div class="input-field-icon">
                      <input type="text" class="input-field" placeholder="HH : MM" name="hours" required="">
                      <div class="icon">
                        <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                           viewBox="0 0 369.946 369.946" width="18px" height="18px" style="enable-background:new 0 0 369.946 369.946;" xml:space="preserve">
                          <g><g>
                          <path d="M184.973,369.946C82.981,369.946,0,286.971,0,184.973C0,82.981,82.981,0,184.973,0
                              c101.998,0,184.973,82.981,184.973,184.973C369.946,286.971,286.971,369.946,184.973,369.946z M184.973,11.934
                              c-95.416,0-173.039,77.623-173.039,173.039c0,95.41,77.623,173.039,173.039,173.039c95.41,0,173.039-77.629,173.039-173.039
                              C358.012,89.557,280.383,11.934,184.973,11.934z"/>
                          </g><g>
                            <polygon points="179.006,199.377 179.006,58.219 190.94,58.219 190.94,170.569 233.358,128.15 
                              241.795,136.588     "/>
                          </g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g>
                        </svg>
                      </div>
                    </div>      
                    <div class="empty-sm-20  empty-xs-20"></div> 
                  </div>
                  <div class="col-md-5">
                    <div class="input-field-icon">
                      <input type="text" class="input-field" placeholder="1" name="amount" required="">
                      <div class="icon">
                        <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 563.43 563.43" width="18px" height="18px" style="enable-background:new 0 0 563.43 563.43;" xml:space="preserve">
                        <path d="M280.79,314.559c83.266,0,150.803-67.538,150.803-150.803S364.055,13.415,280.79,13.415S129.987,80.953,129.987,163.756
                          S197.524,314.559,280.79,314.559z M280.79,52.735c61.061,0,111.021,49.959,111.021,111.021S341.851,274.776,280.79,274.776
                          s-111.021-49.959-111.021-111.021S219.728,52.735,280.79,52.735z"></path>
                        <path d="M19.891,550.015h523.648c11.102,0,19.891-8.789,19.891-19.891c0-104.082-84.653-189.198-189.198-189.198H189.198
                          C85.116,340.926,0,425.579,0,530.124C0,541.226,8.789,550.015,19.891,550.015z M189.198,380.708h185.034
                          c75.864,0,138.313,56.436,148.028,129.524H41.17C50.884,437.607,113.334,380.708,189.198,380.708z"></path>
                        <g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g>
                        </svg>
                      </div>
                    </div>      
                   <div class="empty-sm-20  empty-xs-20"></div> 
                  </div>
                  <div class="col-md-7">
                    <div class="input-field-icon">
                      <input type="text" class="input-field" placeholder="(123) 456 78 90" name="phone" required="">
                      <div class="icon">
                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 29.731 29.731" width="18px" height="18px" style="enable-background:new 0 0 29.731 29.731;" xml:space="preserve"><g><path d="M23.895,29.731c-1.237,0-2.731-0.31-4.374-0.93c-3.602-1.358-7.521-4.042-11.035-7.556
                            c-3.515-3.515-6.199-7.435-7.558-11.037C-0.307,6.933-0.31,4.245,0.921,3.015c0.177-0.177,0.357-0.367,0.543-0.563
                            c1.123-1.181,2.392-2.51,4.074-2.45C6.697,0.05,7.82,0.77,8.97,2.201c3.398,4.226,1.866,5.732,0.093,7.478l-0.313,0.31
                            c-0.29,0.29-0.838,1.633,4.26,6.731c1.664,1.664,3.083,2.882,4.217,3.619c0.714,0.464,1.991,1.166,2.515,0.642l0.315-0.318
                            c1.744-1.769,3.25-3.296,7.473,0.099c1.431,1.15,2.15,2.272,2.198,3.433c0.069,1.681-1.27,2.953-2.452,4.075
                            c-0.195,0.186-0.385,0.366-0.562,0.542C26.103,29.424,25.126,29.731,23.895,29.731z M5.418,1C4.223,1,3.144,2.136,2.189,3.141
                            C1.997,3.343,1.811,3.539,1.628,3.722C0.711,4.638,0.804,7.045,1.864,9.856c1.31,3.472,3.913,7.266,7.33,10.683
                            c3.416,3.415,7.208,6.018,10.681,7.327c2.811,1.062,5.218,1.152,6.133,0.237c0.183-0.183,0.379-0.369,0.581-0.56
                            c1.027-0.976,2.192-2.082,2.141-3.309c-0.035-0.843-0.649-1.75-1.825-2.695c-3.519-2.83-4.503-1.831-6.135-0.176l-0.32,0.323
                            c-0.78,0.781-2.047,0.608-3.767-0.51c-1.193-0.776-2.667-2.038-4.379-3.751c-4.231-4.23-5.584-6.819-4.26-8.146l0.319-0.315
                            c1.659-1.632,2.66-2.617-0.171-6.138C7.245,1.651,6.339,1.037,5.496,1.001C5.47,1,5.444,1,5.418,1z"></path></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g>
                        </svg>
                      </div>
                    </div>      
                   <div class="empty-sm-20  empty-xs-20"></div> 
                  </div>
                  <div class="col-md-12">
                    <div class="input-field-icon">
                      <input type="text" class="input-field" placeholder="FULL NAME" name="name" required="">
                      <div class="icon">
                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 489.7 489.7" width="18px" height="18px" style="enable-background:new 0 0 489.7 489.7;" xml:space="preserve">
                        <g><g>
                          <path id="XMLID_1801_" style="fill:#dfdfdf;" d="M456.8,185.75h-82l-44,42.2v-42.2h-18.7c-13.1,0-23.8-10.7-23.8-23.8v-88.3
                            c0-13.1,10.7-23.8,23.8-23.8h144.7c13.1,0,23.8,10.7,23.8,23.8v88.3C480.6,175.05,469.9,185.75,456.8,185.75z"></path>
                          <path d="M237.4,161.45v-63.8c0-36.7-29.8-66.5-66.5-66.5h-13.7c-36.7,0-66.5,29.8-66.5,66.5v63.8c0,11,4.7,21.2,12.8,28.4v53.2
                            c-13.5,6.8-52.7,27.7-89,57.6c-9.2,7.6-14.5,18.9-14.5,30.9v43.7c0,5,4.1,9.1,9.1,9.1s9.1-4.1,9.1-9.1v-43.7
                            c0-6.6,2.9-12.7,7.9-16.9c38.8-31.9,80.9-53.1,89-57.1c4.1-2,6.7-6.1,6.7-10.7v-61.5c0-3-1.5-5.9-4-7.5c-5.5-3.7-8.8-9.8-8.8-16.4
                            v-63.8c0-26.7,21.7-48.4,48.4-48.4h13.7c26.7,0,48.4,21.7,48.4,48.4v63.8c0,6.6-3.3,12.7-8.8,16.4c-2.5,1.7-4,4.5-4,7.5v61.5
                            c0,4.6,2.6,8.7,6.7,10.7c8.1,3.9,50.2,25.2,89,57.1c5,4.1,7.9,10.3,7.9,16.9v43.7c0,5,4.1,9.1,9.1,9.1s9.1-4.1,9.1-9.1v-43.7
                            c0-12-5.3-23.3-14.5-30.9c-36.4-29.9-75.5-50.8-89-57.6v-53.2C232.7,182.65,237.4,172.35,237.4,161.45z"></path>
                          <path d="M185.2,255.45c-5,0-9.1,4.1-9.1,9.1c0,3.5-1.5,6.6-3.9,8.8c-0.5,0.3-1,0.7-1.5,1.2c-1.9,1.3-4.2,2.1-6.7,2.1
                            c-6.6,0-12.1-5.4-12.1-12.1c0-5-4.1-9.1-9.1-9.1s-9.1,4.1-9.1,9.1c0,7.1,2.5,13.6,6.6,18.8l-6.4,147.5c-0.1,2.7,1,5.3,3,7.1
                            l20.3,18.3c1.7,1.6,3.9,2.3,6.1,2.3c2.2,0,4.4-0.8,6.1-2.3l20.6-18.6c2-1.8,3.1-4.4,3-7.1l-6.6-145.7c4.8-5.4,7.8-12.4,7.8-20.2
                            C194.3,259.55,190.2,255.45,185.2,255.45z M163.4,437.25l-11-9.9l5.7-133.2c1.9,0.4,3.9,0.6,5.9,0.6c1.6,0,3.1-0.2,4.6-0.4
                            l6,132.7L163.4,437.25z"></path>
                          <path d="M435.1,91.35H333.7c-5,0-9.1,4.1-9.1,9.1s4.1,9.1,9.1,9.1h101.4c5,0,9.1-4.1,9.1-9.1S440.1,91.35,435.1,91.35z"></path>
                          <path d="M435.1,127.55H333.7c-5,0-9.1,4.1-9.1,9.1s4.1,9.1,9.1,9.1h101.4c5,0,9.1-4.1,9.1-9.1S440.1,127.55,435.1,127.55z"></path>
                          <path d="M456.8,40.85H312.1c-18.1,0-32.9,14.7-32.9,32.9v88.3c0,18.1,14.7,32.9,32.9,32.9h9.6v33.1c0,3.6,2.2,6.9,5.5,8.3
                            c1.1,0.5,2.4,0.7,3.6,0.7c2.3,0,4.6-0.9,6.3-2.5l41.4-39.6h78.3c18.1,0,32.9-14.7,32.9-32.9v-88.4
                            C489.6,55.55,474.9,40.85,456.8,40.85z M471.5,161.95c0,8.1-6.6,14.7-14.7,14.7h-82c-2.3,0-4.6,0.9-6.3,2.5l-28.7,27.5v-20.9
                            c0-5-4.1-9.1-9.1-9.1H312c-8.1,0-14.7-6.6-14.7-14.7v-88.3c0-8.1,6.6-14.7,14.7-14.7h144.8c8.1,0,14.7,6.6,14.7,14.7V161.95z"></path></g>
                        </g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g>
                        </svg>
                      </div>
                    </div>      
                   <div class="empty-sm-20  empty-xs-20"></div> 
                  </div>
                <div class="col-md-12">
                  <div class="input-field-icon">
                    <textarea class="input-field" placeholder="Supportive message" name="message" ></textarea>
                    <div class="icon area">
                      <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 275.836 275.836"  width="18px" height="18px" style="enable-background:new 0 0 275.836 275.836;" xml:space="preserve">
                      <g>
                      <path d="M191.344,20.922l-95.155,95.155c-0.756,0.756-1.297,1.699-1.565,2.734l-8.167,31.454c-0.534,2.059,0.061,4.246,1.565,5.751
                        c1.14,1.139,2.671,1.757,4.242,1.757c0.503,0,1.009-0.063,1.508-0.192l31.454-8.168c1.035-0.269,1.979-0.81,2.734-1.565
                        l95.153-95.153c0.002-0.002,0.004-0.003,0.005-0.004s0.003-0.004,0.004-0.005l19.156-19.156c2.344-2.343,2.344-6.142,0.001-8.484
                        L218.994,1.758C217.868,0.632,216.343,0,214.751,0c-1.591,0-3.117,0.632-4.242,1.758l-19.155,19.155
                        c-0.002,0.002-0.004,0.003-0.005,0.004S191.346,20.921,191.344,20.922z M120.631,138.208l-19.993,5.192l5.191-19.993l89.762-89.762
                        l14.801,14.802L120.631,138.208z M214.751,14.485l14.801,14.802l-10.675,10.675L204.076,25.16L214.751,14.485z"/>
                      <path d="M238.037,65.022c-3.313,0-6,2.687-6,6v192.813H43.799V34.417h111.063c3.313,0,6-2.687,6-6s-2.687-6-6-6H37.799
                        c-3.313,0-6,2.687-6,6v241.419c0,3.313,2.687,6,6,6h200.238c3.313,0,6-2.687,6-6V71.022
                        C244.037,67.709,241.351,65.022,238.037,65.022z"/>
                      </g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g>
                    </svg>
                    </div>
                  </div>
                </div>
                <div class="empty-sm-30  empty-xs-20"></div> 
                <div class="page-button button-style-1 type-2">
                   <input type="submit">
                   <span class="txt">SUBMIT</span><i></i>
                </div>
              </form>
            </div>
          </div>
        </div>
      <div class="empty-lg-100 empty-md-100 empty-sm-60 empty-xs-60"></div>
    </section>

    <section class="section">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-md-offset-3 col-xs-12">
            <div class="main-caption text-center color-type-2">
              <h2 class="h2">Contact Us</h2>
              <div class="empty-sm-5 empty-xs-5"></div>
              <div class="simple-text md simple-sub-text">
                <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4 col-md-offset-4 col-xs-12">
			<div class="empty-sm-70 empty-xs-30"></div>
            <div class="text-center color-type-2">
              <h4 class="h4 tt color-type-1">working time</h4>
                 <div class="empty-sm-10 empty-xs-10"></div>
                 <div class="simple-text">
                     <p>Ut enimex ea ad minim veniam, quis nostrud exercitation ullamco laboris.</p>
                 </div>
                 <div class="empty-sm-20 empty-xs-10"></div>
                 <ul class="list-style-1 ul-list">
                    <li><div class="flex-wrap"><span>Monday  -  Friday</span><i></i><b>09:00 - 23:00</b></div></li>
                    <li><div class="flex-wrap"><span>Saturday</span><i></i><b>11:00 - 01:00</b></div></li>
                    <li><div class="flex-wrap"><span>Sunday</span><i></i><b>12:00 - 23:00</b></div></li>
                 </ul>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-4 col-xs-12">
            <div class="empty-sm-70 empty-xs-30"></div>
            <div class="text-center color-type-2">
            <div class="contact-icon">
              <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                 viewBox="0 0 512.192 512.192" width="65px" height="65px" style="enable-background:new 0 0 512.192 512.192;" xml:space="preserve">
              <g><g><g>
                    <path d="M440.805,386.456l-60.907-47.467c-17.173-13.44-41.173-13.333-58.24,0.213l-13.547,10.667
                      c-10.24,8.107-24.96,7.253-34.24-2.027l-108.907-109.12c-9.28-9.28-10.133-24.107-2.027-34.453l10.667-13.547
                      c13.547-17.067,13.547-41.173,0.213-58.24l-47.36-61.013c-8.32-10.667-20.8-17.28-34.347-18.133
                      c-13.44-0.747-26.667,4.267-36.267,13.76l-38.827,38.933c-21.653,21.653-52.907,90.987,122.773,266.987
                      c114.453,114.773,184.32,138.88,222.72,138.88c23.147,0,36.587-8.533,43.733-15.787l38.933-38.933
                      c18.453-18.453,18.347-48.427-0.107-66.88C443.685,388.909,442.298,387.629,440.805,386.456z M432.165,440.216
                      c-0.747,0.853-1.387,1.6-2.133,2.347l-38.933,38.933c-4.267,4.373-12.8,9.493-28.693,9.493
                      c-28.16,0-92.587-17.173-207.68-132.587c-132.48-132.8-148.907-210.56-122.667-236.8l38.933-39.04
                      c4.8-4.8,11.307-7.573,18.24-7.573c0.533,0,1.067,0,1.6,0c7.36,0.427,14.187,4.053,18.773,9.92l47.36,61.013
                      c7.36,9.387,7.253,22.613-0.107,32l-10.667,13.547c-14.827,18.773-13.227,45.653,3.627,62.72l108.907,109.227
                      c16.96,16.96,43.84,18.56,62.613,3.627l13.547-10.667c9.28-7.36,22.507-7.467,31.893-0.107l60.907,47.467
                      C438.992,412.589,441.018,428.909,432.165,440.216z"/>
                    <path d="M509.072,3.416c-4.16-4.16-10.88-4.16-15.04,0L288.165,209.282v-91.2c0-5.333-3.84-10.133-9.067-10.88
                      c-6.613-0.96-12.267,4.16-12.267,10.56v117.333c0,5.867,4.8,10.667,10.667,10.667h106.347c5.333,0,10.133-3.84,10.88-9.067
                      c0.96-6.613-4.16-12.267-10.56-12.267h-80.96L509.072,18.562C513.232,14.402,513.232,7.576,509.072,3.416z"/>
                  </g></g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g>
              </svg>
            </div>
            <div class="empty-sm-15 empty-xs-10"></div>
              <h4 class="h4 tt color-type-1">Call us</h4>
                 <div class="empty-sm-20 empty-xs-10"></div>
                 <div class="simple-text contact">
                     <a href="tel:3805623157851" class="link-hover">+38 056 23 15 7851</a>
                 </div>
            </div>
          </div>
          <div class="col-sm-4 col-xs-12">
            <div class="empty-sm-70 empty-xs-30"></div>
            <div class="text-center color-type-2">
            <div class="contact-icon">
              <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                 width="65px" height="65px" viewBox="0 0 491.582 491.582" style="enable-background:new 0 0 491.582 491.582;"
                 xml:space="preserve">
              <g><g>
                  <path d="M245.791,0C153.799,0,78.957,74.841,78.957,166.833c0,36.967,21.764,93.187,68.493,176.926
                    c31.887,57.138,63.627,105.4,64.966,107.433l22.941,34.773c2.313,3.507,6.232,5.617,10.434,5.617s8.121-2.11,10.434-5.617
                    l22.94-34.771c1.326-2.01,32.835-49.855,64.967-107.435c46.729-83.735,68.493-139.955,68.493-176.926
                    C412.625,74.841,337.783,0,245.791,0z M322.302,331.576c-31.685,56.775-62.696,103.869-64.003,105.848l-12.508,18.959
                    l-12.504-18.954c-1.314-1.995-32.563-49.511-64.007-105.853c-43.345-77.676-65.323-133.104-65.323-164.743
                    C103.957,88.626,167.583,25,245.791,25s141.834,63.626,141.834,141.833C387.625,198.476,365.647,253.902,322.302,331.576z"/>
                  <path d="M245.791,73.291c-51.005,0-92.5,41.496-92.5,92.5s41.495,92.5,92.5,92.5s92.5-41.496,92.5-92.5
                    S296.796,73.291,245.791,73.291z M245.791,233.291c-37.22,0-67.5-30.28-67.5-67.5s30.28-67.5,67.5-67.5
                    c37.221,0,67.5,30.28,67.5,67.5S283.012,233.291,245.791,233.291z"/>
                </g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g>
              </svg>
            </div>
            <div class="empty-sm-15 empty-xs-10"></div>
            <h4 class="h4 tt color-type-1">FIND us</h4>
               <div class="empty-sm-20 empty-xs-10"></div>
               <div class="simple-text">
                   <p>150 Duffy Ave, Hicksville, NY 11801, USA</p>
               </div>
            </div>
          </div>
          <div class="col-sm-4 col-xs-12">
            <div class="empty-sm-70 empty-xs-30"></div>
            <div class="text-center color-type-2">
            <div class="contact-icon">
              <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 44 44" width="65px" height="65px" xmlns:xlink="http://www.w3.org/1999/xlink" enable-background="new 0 0 44 44">
              <g><g><g>
                      <path d="M43,6H1C0.447,6,0,6.447,0,7v30c0,0.553,0.447,1,1,1h42c0.552,0,1-0.447,1-1V7C44,6.447,43.552,6,43,6z M42,33.581     L29.612,21.194l-1.414,1.414L41.59,36H2.41l13.392-13.392l-1.414-1.414L2,33.581V8h40V33.581z"/>
                    </g></g><g><g>
                      <path d="M39.979,8L22,25.979L4.021,8H2v0.807L21.293,28.1c0.391,0.391,1.023,0.391,1.414,0L42,8.807V8H39.979z"/>
                    </g></g></g>
              </svg>
            </div>
            <div class="empty-sm-15 empty-xs-10"></div>
              <h4 class="h4 tt color-type-1">MAIL us</h4>
                 <div class="empty-sm-20 empty-xs-10"></div>
                 <div class="simple-text contact">
                     <a href="mailto:delice.info@mail.com" class="link-hover">delice.info@mail.com</a>
                 </div>
            </div>
          </div>
        </div>
      </div>
      <div class="empty-lg-115 empty-md-100 empty-sm-60 empty-xs-60"></div>
    </section>
@endsection