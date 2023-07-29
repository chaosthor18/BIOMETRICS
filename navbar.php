<?php
  $username = $_SESSION['user_username'];
  if(isset($_SESSION['user_username']) && isset($_SESSION['user_password']) && $_SESSION['user_type'] === 'admin789123'){
    include 'db_conn.php';
?>
                <div class="bg-success p-3 min-vh-100 sticky-top">
                    <a class="d-flex text-white text-decoration-none align-items-center">
                        <span class="fs-4 d-none d-sm-inline fw-bold"><img src="/BIOMETRICS/icons/mitsi-icon.png" class="img-fluid" height="200px" width="200px" alt="Responsive image"><br>RFID & Biometrics</span>
                    </a> 
                    <ul class="nav nav-pills flex-column mt-4">
                        <li class="nav-item py-2 py-sm-1" role="presentation">
                            <a href="./index" class="nav-link text-white links-navigation" aria-current="page">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="white" class="bi bi-speedometer2" viewBox="0 0 16 16">
                                    <path d="M8 4a.5.5 0 0 1 .5.5V6a.5.5 0 0 1-1 0V4.5A.5.5 0 0 1 8 4zM3.732 5.732a.5.5 0 0 1 .707 0l.915.914a.5.5 0 1 1-.708.708l-.914-.915a.5.5 0 0 1 0-.707zM2 10a.5.5 0 0 1 .5-.5h1.586a.5.5 0 0 1 0 1H2.5A.5.5 0 0 1 2 10zm9.5 0a.5.5 0 0 1 .5-.5h1.5a.5.5 0 0 1 0 1H12a.5.5 0 0 1-.5-.5zm.754-4.246a.389.389 0 0 0-.527-.02L7.547 9.31a.91.91 0 1 0 1.302 1.258l3.434-4.297a.389.389 0 0 0-.029-.518z"/>
                                    <path fill-rule="evenodd" d="M0 10a8 8 0 1 1 15.547 2.661c-.442 1.253-1.845 1.602-2.932 1.25C11.309 13.488 9.475 13 8 13c-1.474 0-3.31.488-4.615.911-1.087.352-2.49.003-2.932-1.25A7.988 7.988 0 0 1 0 10zm8-7a7 7 0 0 0-6.603 9.329c.203.575.923.876 1.68.63C4.397 12.533 6.358 12 8 12s3.604.532 4.923.96c.757.245 1.477-.056 1.68-.631A7 7 0 0 0 8 3z"/>
                                </svg>
                                <span class="fs-5 d-none d-sm-inline ms-2">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item py-2 py-sm-1">
                            <a href="rfid_page" class="nav-link text-white" aria-current="page">
                                <svg id="Layer_1" data-name="Layer 1" width="30" height="30" xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 122.88 122.02"><title>rfid</title><path d="M62.19,48.52a9.83,9.83,0,0,0-.25-19.61h-1a9.83,9.83,0,0,0,0,19.63h1.25ZM24.53,91q6,0,9.29,2.7a8.86,8.86,0,0,1,3.24,7.16q0,5.11-3.17,7.7c-2.11,1.72-5.19,2.58-9.22,2.58l-1.08.56H18.42V122H7.72V91Zm-1.88,13.52a4.41,4.41,0,0,0,2.6-.63,3.27,3.27,0,0,0,0-4.44,4.26,4.26,0,0,0-2.6-.66H18.42v5.73Zm6.47,2.3L38.79,122H26.92l-7.23-13.56,9.43-1.6Zm37.37-7.79H51.75v4.32H63.67v8H51.75V122H40.81V91H66.49v8Zm14.08-8v31H69.63V91Zm19.9,0q7.27,0,11,4t3.71,11.45q0,7.36-3.71,11.43t-11,4.06H85.26V91Zm-1.55,23.19c2,0,3.38-.62,4.06-1.86a12.78,12.78,0,0,0,1-5.84,12.78,12.78,0,0,0-1-5.84c-.68-1.24-2-1.86-4.06-1.86H96.19v15.4ZM41.57,21.77a4.5,4.5,0,0,0-.51-6.2l-.29-.23a4.4,4.4,0,0,0-3.14-.86,4.45,4.45,0,0,0-2.9,1.5,1.79,1.79,0,0,0-.22.25,41.63,41.63,0,0,0-6.45,10.92A31.56,31.56,0,0,0,28,50.43a40.44,40.44,0,0,0,6.49,10.93,4.49,4.49,0,0,0,6.31.65h0a4.5,4.5,0,0,0,.65-6.32h0a31.57,31.57,0,0,1-5-8.36,22.93,22.93,0,0,1-1.65-8.51,23.32,23.32,0,0,1,1.71-8.56,32.39,32.39,0,0,1,5.08-8.49ZM22.4,7.54a1.37,1.37,0,0,0,.19-.23,4.45,4.45,0,0,0-.43-6.1,1.37,1.37,0,0,0-.22-.2,4.48,4.48,0,0,0-6.18.5A67.93,67.93,0,0,0,3.84,19.91,46.8,46.8,0,0,0,0,39,46.8,46.8,0,0,0,4.47,58,68.05,68.05,0,0,0,17,76.05l.11.11a4.48,4.48,0,0,0,6.23.08l.11-.1a4.56,4.56,0,0,0,1.31-3,4.48,4.48,0,0,0-1.22-3.21A59.49,59.49,0,0,1,12.72,54.48,38.08,38.08,0,0,1,9,38.89a38.45,38.45,0,0,1,3.23-15.72A59,59,0,0,1,22.4,7.54ZM81.31,21.77a4.5,4.5,0,0,1,.51-6.2l.28-.23a4.49,4.49,0,0,1,6.05.64,1.27,1.27,0,0,1,.21.25,41.4,41.4,0,0,1,6.46,10.92,31.56,31.56,0,0,1,.07,23.28A40.44,40.44,0,0,1,88.4,61.36a4.49,4.49,0,0,1-6.31.65h0a4.48,4.48,0,0,1-1.63-3,4.55,4.55,0,0,1,1-3.3h0a31.57,31.57,0,0,0,5-8.36,22.93,22.93,0,0,0,1.65-8.51,23.32,23.32,0,0,0-1.71-8.56,32.39,32.39,0,0,0-5.08-8.49ZM100.48,7.54a1.37,1.37,0,0,1-.19-.23,4.45,4.45,0,0,1,.43-6.1,1.37,1.37,0,0,1,.22-.2,4.48,4.48,0,0,1,6.18.5A67.93,67.93,0,0,1,119,19.91,46.8,46.8,0,0,1,122.87,39a46.8,46.8,0,0,1-4.46,19,68.05,68.05,0,0,1-12.52,18l-.11.11a4.48,4.48,0,0,1-6.23.08l-.11-.1a4.56,4.56,0,0,1-1.31-3,4.48,4.48,0,0,1,1.22-3.21,59.49,59.49,0,0,0,10.81-15.42,38.08,38.08,0,0,0,3.76-15.59,38.45,38.45,0,0,0-3.23-15.72A59,59,0,0,0,100.48,7.54Z"/></svg>
                                <span class="fs-5 d-none d-sm-inline ms-2">RFID</span>
                            </a>
                        </li>
                        <li class="nav-item py-2 py-sm-1">
                            <a href="./fingerprint_page" class="nav-link text-white" aria-current="page">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="white" class="bi bi-fingerprint" viewBox="0 0 16 16">
                                    <path d="M8.06 6.5a.5.5 0 0 1 .5.5v.776a11.5 11.5 0 0 1-.552 3.519l-1.331 4.14a.5.5 0 0 1-.952-.305l1.33-4.141a10.5 10.5 0 0 0 .504-3.213V7a.5.5 0 0 1 .5-.5Z"/>
                                    <path d="M6.06 7a2 2 0 1 1 4 0 .5.5 0 1 1-1 0 1 1 0 1 0-2 0v.332c0 .409-.022.816-.066 1.221A.5.5 0 0 1 6 8.447c.04-.37.06-.742.06-1.115V7Zm3.509 1a.5.5 0 0 1 .487.513 11.5 11.5 0 0 1-.587 3.339l-1.266 3.8a.5.5 0 0 1-.949-.317l1.267-3.8a10.5 10.5 0 0 0 .535-3.048A.5.5 0 0 1 9.569 8Zm-3.356 2.115a.5.5 0 0 1 .33.626L5.24 14.939a.5.5 0 1 1-.955-.296l1.303-4.199a.5.5 0 0 1 .625-.329Z"/>
                                    <path d="M4.759 5.833A3.501 3.501 0 0 1 11.559 7a.5.5 0 0 1-1 0 2.5 2.5 0 0 0-4.857-.833.5.5 0 1 1-.943-.334Zm.3 1.67a.5.5 0 0 1 .449.546 10.72 10.72 0 0 1-.4 2.031l-1.222 4.072a.5.5 0 1 1-.958-.287L4.15 9.793a9.72 9.72 0 0 0 .363-1.842.5.5 0 0 1 .546-.449Zm6 .647a.5.5 0 0 1 .5.5c0 1.28-.213 2.552-.632 3.762l-1.09 3.145a.5.5 0 0 1-.944-.327l1.089-3.145c.382-1.105.578-2.266.578-3.435a.5.5 0 0 1 .5-.5Z"/>
                                    <path d="M3.902 4.222a4.996 4.996 0 0 1 5.202-2.113.5.5 0 0 1-.208.979 3.996 3.996 0 0 0-4.163 1.69.5.5 0 0 1-.831-.556Zm6.72-.955a.5.5 0 0 1 .705-.052A4.99 4.99 0 0 1 13.059 7v1.5a.5.5 0 1 1-1 0V7a3.99 3.99 0 0 0-1.386-3.028.5.5 0 0 1-.051-.705ZM3.68 5.842a.5.5 0 0 1 .422.568c-.029.192-.044.39-.044.59 0 .71-.1 1.417-.298 2.1l-1.14 3.923a.5.5 0 1 1-.96-.279L2.8 8.821A6.531 6.531 0 0 0 3.058 7c0-.25.019-.496.054-.736a.5.5 0 0 1 .568-.422Zm8.882 3.66a.5.5 0 0 1 .456.54c-.084 1-.298 1.986-.64 2.934l-.744 2.068a.5.5 0 0 1-.941-.338l.745-2.07a10.51 10.51 0 0 0 .584-2.678.5.5 0 0 1 .54-.456Z"/>
                                    <path d="M4.81 1.37A6.5 6.5 0 0 1 14.56 7a.5.5 0 1 1-1 0 5.5 5.5 0 0 0-8.25-4.765.5.5 0 0 1-.5-.865Zm-.89 1.257a.5.5 0 0 1 .04.706A5.478 5.478 0 0 0 2.56 7a.5.5 0 0 1-1 0c0-1.664.626-3.184 1.655-4.333a.5.5 0 0 1 .706-.04ZM1.915 8.02a.5.5 0 0 1 .346.616l-.779 2.767a.5.5 0 1 1-.962-.27l.778-2.767a.5.5 0 0 1 .617-.346Zm12.15.481a.5.5 0 0 1 .49.51c-.03 1.499-.161 3.025-.727 4.533l-.07.187a.5.5 0 0 1-.936-.351l.07-.187c.506-1.35.634-2.74.663-4.202a.5.5 0 0 1 .51-.49Z"/>
                                </svg>
                                <span class="fs-5 d-none d-sm-inline ms-2">Fingerprints</span>
                            </a>
                        </li>
                        <li class="nav-item py-2 py-sm-1">
                            <a href="./print_page" class="nav-link text-white" aria-current="page">
                            <svg
                                xmlns:dc="http://purl.org/dc/elements/1.1/"
                                xmlns:cc="http://creativecommons.org/ns#"
                                xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
                                xmlns:svg="http://www.w3.org/2000/svg"
                                xmlns="http://www.w3.org/2000/svg"
                                xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd"
                                xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape"
                                viewBox="0 -256 1792 1792"
                                id="svg3037"
                                version="1.1"
                                inkscape:version="0.48.3.1 r9886"
                                width="30"
                                height="30"
                                sodipodi:docname="print_font_awesome.svg">
                                <metadata
                                    id="metadata3047">
                                    <rdf:RDF>
                                    <cc:Work
                                        rdf:about="">
                                        <dc:format>image/svg+xml</dc:format>
                                        <dc:type
                                        rdf:resource="http://purl.org/dc/dcmitype/StillImage" />
                                    </cc:Work>
                                    </rdf:RDF>
                                </metadata>
                                <defs
                                    id="defs3045" />
                                <sodipodi:namedview
                                    pagecolor="#ffffff"
                                    bordercolor="#666666"
                                    borderopacity="1"
                                    objecttolerance="10"
                                    gridtolerance="10"
                                    guidetolerance="10"
                                    inkscape:pageopacity="0"
                                    inkscape:pageshadow="2"
                                    inkscape:window-width="640"
                                    inkscape:window-height="480"
                                    id="namedview3043"
                                    showgrid="false"
                                    inkscape:zoom="0.13169643"
                                    inkscape:cx="896"
                                    inkscape:cy="896"
                                    inkscape:window-x="0"
                                    inkscape:window-y="25"
                                    inkscape:window-maximized="0"
                                    inkscape:current-layer="svg3037" />
                                <g
                                    transform="matrix(1,0,0,-1,53.152542,1270.2373)"
                                    id="g3039">
                                    <path
                                    d="m 384,0 h 896 V 256 H 384 V 0 z m 0,640 h 896 v 384 h -160 q -40,0 -68,28 -28,28 -28,68 v 160 H 384 V 640 z m 1152,-64 q 0,26 -19,45 -19,19 -45,19 -26,0 -45,-19 -19,-19 -19,-45 0,-26 19,-45 19,-19 45,-19 26,0 45,19 19,19 19,45 z m 128,0 V 160 q 0,-13 -9.5,-22.5 Q 1645,128 1632,128 H 1408 V -32 q 0,-40 -28,-68 -28,-28 -68,-28 H 352 q -40,0 -68,28 -28,28 -28,68 V 128 H 32 Q 19,128 9.5,137.5 0,147 0,160 V 576 Q 0,655 56.5,711.5 113,768 192,768 h 64 v 544 q 0,40 28,68 28,28 68,28 h 672 q 40,0 88,-20 48,-20 76,-48 l 152,-152 q 28,-28 48,-76 20,-48 20,-88 V 768 h 64 q 79,0 135.5,-56.5 Q 1664,655 1664,576 z"
                                    id="path3041"
                                    inkscape:connector-curvature="0"
                                    style="fill:currentColor" />
                                </g>
                                </svg>
                                <span class="fs-5 d-none d-sm-inline ms-2">Print</span>
                            </a>
                        </li>
                        <li class="nav-item py-2 py-sm-1">
                            <a href="./changepass_page" class="nav-link text-white" aria-current="page">
                            <svg fill="white" height="30" width="30" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                                viewBox="0 0 485.017 485.017" xml:space="preserve">
                            <g>
                                <path d="M361.205,68.899c-14.663,0-28.447,5.71-38.816,16.078c-21.402,21.403-21.402,56.228,0,77.631
                                    c10.368,10.368,24.153,16.078,38.815,16.078s28.447-5.71,38.816-16.078c21.402-21.403,21.402-56.228,0-77.631
                                    C389.652,74.609,375.867,68.899,361.205,68.899z M378.807,141.394c-4.702,4.702-10.953,7.292-17.603,7.292
                                    s-12.901-2.59-17.603-7.291c-9.706-9.706-9.706-25.499,0-35.205c4.702-4.702,10.953-7.291,17.603-7.291s12.9,2.589,17.603,7.291
                                    C388.513,115.896,388.513,131.688,378.807,141.394z"/>
                                <path d="M441.961,43.036C414.21,15.284,377.311,0,338.064,0c-39.248,0-76.146,15.284-103.897,43.036
                                    c-42.226,42.226-54.491,105.179-32.065,159.698L0.254,404.584l-0.165,80.268l144.562,0.165v-55.722h55.705l0-55.705h55.705v-64.492
                                    l26.212-26.212c17.615,7.203,36.698,10.976,55.799,10.976c39.244,0,76.14-15.282,103.889-43.032
                                    C499.25,193.541,499.25,100.325,441.961,43.036z M420.748,229.617c-22.083,22.083-51.445,34.245-82.676,34.245
                                    c-18.133,0-36.237-4.265-52.353-12.333l-9.672-4.842l-49.986,49.985v46.918h-55.705l0,55.705h-55.705v55.688l-84.5-0.096
                                    l0.078-37.85L238.311,208.95l-4.842-9.672c-22.572-45.087-13.767-99.351,21.911-135.029C277.466,42.163,306.83,30,338.064,30
                                    c31.234,0,60.598,12.163,82.684,34.249C466.34,109.841,466.34,184.025,420.748,229.617z"/>
                            </g>
                            </svg>
                                <span class="fs-5 d-none d-sm-inline ms-2">Change Password</span>
                            </a>
                        </li>
                        <li class="nav-item py-2 py-sm-1">
                            <a href="./payroll_page" class="nav-link text-white" aria-current="page">
                            <svg fill="#FFFFFF" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="30" height="30" viewBox="0 0 946 946" xml:space="preserve">
                                <g>
                                    <g>
                                        <path d="M403.85,538.6v-21.1v-77.1h98.3v37.7c20.299-17.5,42.9-31.9,67.299-43v-400c0-19.4-15.699-35.1-35.1-35.1h-493
                                            c-19.4,0-35.1,15.7-35.1,35.1v716.3c0,19.4,15.7,35.1,35.1,35.1h378c-10.5-30-15.9-61.4-15.9-93.6c0-4.801,0.101-9.6,0.4-14.4
                                            V538.6z M502.15,379.1h-98.3v-98.3h98.3V379.1z M171.85,698.199h-98.3V599.9h98.3V698.199z M171.85,538.6h-98.3V440.3h98.3V538.6z
                                            M171.85,379.1h-98.3v-98.3h98.3V379.1z M336.95,698.199h-98.3V599.9h98.3V698.199L336.95,698.199z M336.95,538.6h-98.3V440.3
                                            h98.3V538.6L336.95,538.6z M336.95,379.1h-98.3v-98.3h98.3V379.1L336.95,379.1z M73.55,199.7v-127h428.6v127H73.55z"/>
                                        <path d="M451.45,786.5C488.65,879.9,579.949,946,686.65,946c139.799,0,253.1-113.301,253.1-253.1
                                            c0-139.801-113.301-253.201-253.1-253.201c-42.301,0-82.201,10.4-117.201,28.7c-25.199,13.2-48,30.5-67.299,51.1
                                            c-42.5,45.301-68.6,106.199-68.6,173.301c0,1.799,0,3.5,0.1,5.299C434.25,729.301,440.45,759.1,451.45,786.5z M733.85,728.301
                                            c-10.199-12.5-27.699-17.801-43.4-21.4c-19.5-4.4-37.1-8.9-54.699-18.701c-11.301-6.299-20.199-15.199-26.301-26.398
                                            c-6.1-11.102-9.199-23.9-9.199-38c0-25.102,9-45.701,26.801-61.201c10.5-9.199,24.898-15.6,41.199-18.6v-13.699
                                            c0-9.201,7.5-16.701,16.699-16.701h9.102c9.199,0,16.699,7.5,16.699,16.701V544.1c15.1,2.9,28.5,8.801,38.6,17.201
                                            c10.701,8.898,18.5,20.1,23.301,33.5c3.6,9.898-2.9,20.5-13.301,22.1l-8.799,1.299c-8,1.201-15.701-3.5-18.301-11.199
                                            c-2.1-6.199-5-11.4-8.5-15.4c-8-8.9-20.6-14.1-34.5-14.1c-14.801,0-28.801,5.801-37.5,15.5c-7.1,7.9-10.5,17.1-10.5,28
                                            c0,10.699,3,19.699,8.9,26.801c12.299,14.799,32.5,18.898,52,22.799c11.4,2.301,23.199,4.701,33.4,9.201
                                            c10.898,4.799,19.898,10.799,26.898,17.699c7,7,12.4,15.4,16.102,24.9c3.699,9.5,5.6,20,5.6,31c0,24.299-7.9,44.9-23.4,61.199
                                            c-12.699,13.4-30.1,22.201-50,25.801v10.1c0,9.199-7.5,16.699-16.699,16.699h-9.102c-9.199,0-16.699-7.5-16.699-16.699v-10.4
                                            c-11-2.1-21.5-5.6-30.9-10.5c-11.1-5.699-20.799-15-28.9-27.699c-5.398-8.4-9.199-18.201-11.6-29.201
                                            c-2-9.199,4.201-18.299,13.5-19.898l9-1.602c8.6-1.5,16.9,3.9,19.1,12.4c2.602,10,6,17.801,10.301,23.301
                                            c9.6,12.299,25.4,19.699,42.4,19.699l0,0c2.9,0,5.799-0.199,8.6-0.6c12.1-1.801,23-7.6,30.5-16.199c8-9.102,12-20.5,12-34
                                            C742.15,744.301,739.35,735.1,733.85,728.301z"/>
                                    </g>
                                </g>
                                </svg>
                                <span class="fs-5 d-none d-sm-inline ms-2">Payroll</span>
                            </a>
                        </li>
                        <li class="nav-item py-2 py-sm-1" role="presentation">
                            <a href="./logout" class="nav-link text-white" aria-current="page">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="white" class="bi bi-box-arrow-left" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0v2z"/>
                                    <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z"/>
                                </svg>
                                <span class="fs-5 d-none d-sm-inline ms-2">Log-out</span>
                            </a>
                        </li>
                    </ul>
                </div>
<?php
  }
  else{
    header("Location: logout.php");
  }
?>