import {Navbar, Container, Nav} from "react-bootstrap"
import "../style/landingPage.css";
import myLogo from "../assets/brand/logo-berkah.png";

const NavigationBar = () => {
    return (
        <div className="Nav-wrapped">
            <Navbar>
                <Container>
                    <Navbar.Brand>
                        <a href="#">
                            <img src= {myLogo} alt="logo-berkah" width={30} />
                        </a>
                    </Navbar.Brand>
                    <Nav>
                         <Nav.Link>HOME</Nav.Link>
                         <Nav.Link>SERVICE</Nav.Link>
                         <Nav.Link>ABOUT US</Nav.Link>
                         <Nav.Link>CONTACT</Nav.Link>
                         <Nav.Link>PRODUCT</Nav.Link>
                         <Nav.Link>CATEGORY</Nav.Link>
                    </Nav>
                </Container>
            </Navbar>
        </div>
    )
}

export default NavigationBar;