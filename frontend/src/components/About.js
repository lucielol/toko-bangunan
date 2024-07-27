import { Row, Col, Container } from "react-bootstrap";
import "../style/landingPage.css";

const About = () => {
    return(
        <div className="about">
            <Container className="text-white text-center d-flex justify-content-center align-items-center ">
                <Row>
                    <Col>
                        <div className="titleAbout">About Us</div>
                    </Col>
                </Row>
            </Container>
        </div>
    )
}

export default About;